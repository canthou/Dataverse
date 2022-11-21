<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DvUser;
use App\Models\Dv_users_role;
use App\Models\Dv_users_roles_has_dv_user;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $all_users = DvUser::get();
        return view('welcome', compact('all_users'));
    }

    public function new_user(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:dv_users',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        DB::transaction( function ($request) {
            
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

            foreach($roles as $i => $role){
                $permission = new Dv_users_roles_has_dv_user();
                $permission_id = Dv_users_role::select('id')->where('name', $role)->first()['id'];
                $permission->dv_users_roles_id = $permission_id;
                $permission->dv_users_id = $new_user_id;
                $permission->save();
            }

        });

        return redirect()->route('home')->with('success','Επιτυχής καταχώρηση!');
    }
}
