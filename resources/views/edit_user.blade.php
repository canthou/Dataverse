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
              <form action="{{ route('add_new_user') }}" method="POST" class="was-validated" id="add_new_user">
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
                  <input id="password" type="password" 
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
                  
                  {{-- Τεχνικός Διαχειριστής --}}
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="technical-admin" name='admin-role[]' value="Τεχνικός Διαχειριστής">
                    <label class="form-check-label" for="technical-admin">Τεχνικός Διαχειριστής</label>
                  </div>

                  {{-- Διαχειριστής χρηστών και συνδρομών --}}
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="user-subs-admin" name='admin-role[]' value="Διαχειριστής χρηστών και συνδρομών">
                    <label class="form-check-label" for="user-subs-admin">Διαχειριστής χρηστών και συνδρομών</label>
                  </div>

                  {{-- Διαχειριστής ερωτημάτων/απαντήσεων --}}
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="qa-admin" name='admin-role[]' value="Διαχειριστής ερωτημάτων/απαντήσεων">
                    <label class="form-check-label" for="qa-admin">Διαχειριστής ερωτημάτων/απαντήσεων</label>
                  </div>

                  {{-- Διαχειριστής Περιεχομένου --}}
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="content-admin" name='admin-role[]' value="Διαχειριστής Περιεχομένου">
                    <label class="form-check-label" for="content-admin">Διαχειριστής Περιεχομένου</label>
                  </div>

                  {{-- Διαχειριστής νομολογίας - νομοθεσίας --}}
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="law-admin" name='admin-role[]' value="Διαχειριστής νομολογίας - νομοθεσίας">
                    <label class="form-check-label" for="law-admin">Διαχειριστής νομολογίας - νομοθεσίας</label>
                  </div>

                  {{-- Διαχειριστής ενημερωτικών δελτίων και νέων --}}
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="news-admin" name='admin-role[]' value="Διαχειριστής ενημερωτικών δελτίων και νέων">
                    <label class="form-check-label" for="news-admin">Διαχειριστής ενημερωτικών δελτίων και νέων</label>
                  </div>

                </div>

                <button type="submit" class="btn btn-primary">Καταχώρηση</button>

              </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="{{ asset('js/ajax.js') }}" defer></script>
</body>
</html>