<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Consultorio</title>
      <!-- Custom fonts for this template-->
      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet" type="text/css" />
   </head>
   <body class="bg-gradient-primary" style="height:100vh;">
      <div class="container h-100">
      <div class="row justify-content-center h-100">
         <div class="col-xl-10 col-lg-12 col-md-9 my-auto">
            <div class="card o-hidden border-0 shadow-lg my-5">
               <div class="card-body  p-0">
                  <!-- Nested Row within Card Body -->
                  <div class="row">
                     <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                     <div class="col-lg-6">
                        <div class="p-5">
                           <div class="text-center">
                              <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                           </div>
                           <form class="user" method="POST" action="{{ route('login') }}">
                              @csrf
                              <div class="form-group">
                                 <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electrónico">
                                 @error('email')
                                 <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror                                
                              </div>
                              <div class="form-group">
                                 <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                                 @error('password')
                                 <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror                                
                              </div>
                              <div class="form-group">
                              <!--
                                 <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">
                                    Recuérdame
                                    </label>
                                 </div> -->
                              </div>
                              <button type="submit" class="btn btn-primary btn-user btn-block">
                              Inicia sesión
                              </button>
                              <hr>
                              <div class="text-center">
                                 @if (Route::has('password.request'))
                                 <a class="small" href="{{ route('password.request') }}">
                                 Olvidé mi contraseña
                                 </a>
                                 @endif
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Bootstrap core JavaScript-->
      <script src="{{ asset('vendor/jquery/jquery.min.js') }}" type="text/js"></script>
      <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/js"></script>
      <!-- Core plugin JavaScript-->
      <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}" type="text/js"></script>
      <!-- Custom scripts for all pages-->
      <script src="{{ asset('js/sb-admin-2.min.js') }}" type="text/js"></script>
   </body>
</html>
