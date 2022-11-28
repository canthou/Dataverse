<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{csrf_token()}}" />
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

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UserModal">
                Εγγραφή Νέου Χρήστη
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="UserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="UserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="UserModalLabel">Καταχώρηση Νέου Χρήστη</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="main_content pt-5">
                            <div class="container">
                                <div class="row">
                                
                                    @csrf
                    
                                    {{-- Ενεργός --}}
                                    <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="active" name="active">
                                    <label class="form-check-label" for="active">Ενεργός</label>
                                    </div>
                    
                                    {{-- Ονοματεπώνυμο --}}
                                    <div class="col-md-6">
                                    <label for="name" class="form-label fw-bold">Ονοματεπώνυμο</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                    <div class="valid-feedback">Έγκυρο.</div>
                                    <div class="invalid-feedback">Μη Έγκυρο.</div>
                                    @error('name')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                    </div>
                    
                                    {{-- Όνομα Χρήστη --}}
                                    <div class="col-md-6">
                                    <label for="username" class="form-label fw-bold">Όνομα Χρήστη</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                                    <div class="valid-feedback">Έγκυρο.</div>
                                    <div class="invalid-feedback">Μη Έγκυρο.</div>
                                    @error('username')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                    </div>
                                    
                                    {{-- Κωδικός --}}
                                    <div class="col-md-6">
                                        <label for="password" class="col-md-4 col-form-label text-md-right fw-bold">Κωδικός</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        <div class="valid-feedback">Έγκυρο.</div>
                                        <div class="invalid-feedback">Μη Έγκυρο.</div>
                    
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                    
                                    {{-- Επιβεβαίωση Κωδικού --}}
                                    <div class="col-md-6">
                                    <label for="password" class="col-md-4 col-form-label text-md-right fw-bold">Επιβεβαίωση Κωδικού</label>
                                    <input id="password-check" type="password" 
                                        class="form-control @error('password') is-invalid @enderror" 
                                        name="password_confirmation" required autocomplete="current-password">
                                        
                                    <div class="valid-feedback">Έγκυρο.</div>
                                    <div class="invalid-feedback">Μη Έγκυρο.</div>
                                    </div>
                    
                                    {{-- Email --}}
                                    <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                    <div class="valid-feedback">Έγκυρο.</div>
                                    <div class="invalid-feedback">Μη Έγκυρο.</div>
                                    @error('email')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                    </div>
                    
                                    <div class="form-group row pt-3">
                    
                                    <label for="permissions">Δικαιώματα</label>
                    
                                    @foreach( $all_roles as $role)
                                        <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" name='admin-role' value="{{ $role['name'] }}"
                                        >
                                        <label class="form-check-label">{{ $role['name'] }}</label>
                                        </div>
                                    @endforeach
                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Κλείσιμο</button>
                        <button type="submit" class="btn btn-primary add_user">Καταχώρηση</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
          
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/ajax.js') }}" defer></script>
</body>
</html>