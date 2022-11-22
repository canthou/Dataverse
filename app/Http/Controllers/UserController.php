<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DvUser;
use App\Models\Dv_users_role;
use App\Models\Dv_users_roles_has_dv_user;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $all_users = DvUser::get();
        $all_roles = Dv_users_role::get();
        return view('welcome', compact('all_users', 'all_roles'));
    }
    
    public function create_new_user()
    {
        $all_roles = Dv_users_role::get();
        return view('new_user', compact('all_roles'));
    }
    
    public function new_user(Request $request)
    {
        DB::transaction(function() use($request){

            $request->validate([
                'name' => 'required',
                'username' => 'required|unique:dv_users',
                'email' => 'required|email',
                'password' => 'required|confirmed'
            ]);
            
            $new_user = new DvUser();
            $new_user->name = $request->name;
            $new_user->username = $request->username;
            $new_user->password = $request->password;
            $new_user->email = $request->email;
            $new_user->wp_users_ID = rand(1,50);
            if($request->has('active')){
                $new_user->is_active = 1;
            }
            $new_user->save();

            $new_user_id = DvUser::select('id')->orderBy('id', 'desc')->first()['id'];
            $roles = $request->get('admin-role');

            foreach($roles as $role){
                $permission = new Dv_users_roles_has_dv_user();
                $permission_id = Dv_users_role::select('id')->where('name', $role)->first()['id'];
                $permission->dv_users_roles_id = $permission_id;
                $permission->dv_users_id = $new_user_id;
                $permission->save();
            }

        });

        return redirect()->route('home')->with('success','Επιτυχής καταχώρηση!');
    }

    public function edit_user($id)
    {
        $all_roles = Dv_users_role::get();
        $current_user = DvUser::find($id);
        return view('edit_user', compact('current_user', 'all_roles'));
    }

    public function update_user(Request $request, $id)
    {
        DB::transaction(function() use($request, $id){

            Validator::make($request->all(), [
                'name' => 'required',
                'username' => ['required',
                Rule::unique('dv_users')->ignore($id)],
                'email' => 'required|email',
                'password' => ['required', 'confirmed'],
            ], 
            [
                'required' => 'The :attribute field is required.',
                'unique' => 'The :attribute field should be unique.',
            ]);

            $updated_user = DvUser::where('id', $id)->first();
            $updated_user->name = $request->name;
            $updated_user->username = $request->username;
            $updated_user->password = $request->password;
            $updated_user->email = $request->email;
            
            if($request->has('active')){
                $updated_user->is_active = 1;
            }else{
                $updated_user->is_active = 0;
            }
            $updated_user->update();
            // $roles = $request->get('admin-role');
            
            // foreach($roles as $role){
            //     $permission = Dv_users_roles_has_dv_user::where('dv_users_id', $id)->first();
            //     $permission_id = Dv_users_role::select('id')->where('name', $role)->first()['id'];
            //     $permission->dv_users_roles_id = $permission_id;
            //     $permission->dv_users_id = $id;
            //     $permission->update();
            // }

        });
        return redirect()->route('home')->with('success','Επιτυχής ενημέρωση!');

    }

    public function delete_user($id)
    {   
        DB::transaction(function() use($id){
            $deleted_user = DvUser::find($id);
            $deleted_user->roles()->detach();
            $deleted_user->delete();
        });
        return redirect()->back()->with('success', 'Επιτυχής Διαγραφή!');

    }

}
