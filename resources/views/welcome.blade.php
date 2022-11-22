<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    
    <div class="main_content pt-5">
        <div class="container">
            <div class="row">

                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Όνομα</th>
                            <th scope="col">Όνομα Χρήστη</th>
                            <th scope="col">Δικαιώματα</th>
                            <th scope="col">Ενεργός</th>
                            <th scope="col">Ενέργειες</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse($all_users as $user)
                            <tr>
                                <th scope="row">
                                    {{ $user->name }}
                                </th>
                                <td>
                                    {{ $user->username }}
                                </td>
                                <td>
                                    @forelse ($user->roles as $role)
                                        {{ $role['name'] }}<br>
                                    @empty
                                        Δεν υπάρχουν ρόλοι στο συγκεκριμένο χρήστη
                                    @endforelse
                                </td>
                                <td>{{ $user->is_active }}</td>
                                <td>
                                    <a href="{{ route('edit_user', $user->id) }}">Επεξεργασία</a>
                                    <a href="{{ route('delete_user', $user->id) }}" onClick="return confirm('Είστε σίγουροι ότι θέλετε να διαγράψετε το χρήστη;')">Διαγραφή</a>
                                </td>
                            @empty
                                Δεν υπάρχουν εγγραφές στον πίνακα!
                            </tr>
                            @endforelse
                            
                          
                        </tbody>
                    </table>                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ route('new_user') }}" class="btn btn-primary">Εγγραφή Νέου Χρήστη</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>