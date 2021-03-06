<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>Consultorio Cerón</title>

   <link rel="icon" type="image/png" sizes="192x192" href="{{ asset(config('myconfig.public_path').'/img/android-icon-192x192.png')}}">
   <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(config('myconfig.public_path').'/img/favicon-32x32.png')}}">
   <link rel="icon" type="image/png" sizes="96x96" href="{{ asset(config('myconfig.public_path').'/img/favicon-96x96.png')}}">
   <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(config('myconfig.public_path').'/img/favicon-16x16.png')}}">
   <link rel="manifest" href="{{ asset(config('myconfig.public_path').'/img/manifest.json')}}">

   <!-- Scripts -->
   <script src="{{ asset(config('myconfig.public_path').'/js/app.js') }}" defer></script>
   <!-- Fonts -->
   <link rel="dns-prefetch" href="//fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <link href="{{ asset(config('myconfig.public_path').'/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
   <!-- Styles -->
   <link href="{{ asset(config('myconfig.public_path').'/css/app.css') }}" rel="stylesheet">
   <link href="{{ asset(config('myconfig.public_path').'/css/styles.css') }}" rel="stylesheet">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link href="{{ asset(config('myconfig.public_path').'/css/sb-admin-2.css') }}" rel="stylesheet">

   <!-- Bootstrap core JavaScript-->
   <script src="{{ asset(config('myconfig.public_path').'/vendor/jquery/jquery.min.js') }}"></script>
   <!-- Core plugin JavaScript-->
   <script src="{{ asset(config('myconfig.public_path').'/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
   <!-- Custom scripts for all pages-->
   <script src="{{ asset(config('myconfig.public_path').'/js/sb-admin-2.min.js') }}"></script>
   <!-- Page level plugins -->
   <script src="{{ asset(config('myconfig.public_path').'/vendor/chart.js/Chart.min.js') }}"></script>
   <!-- Page level custom scripts
   <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
   <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script> -->
   <!-- Custom scripts -->
   <script src="{{ asset(config('myconfig.public_path').'/js/scripts.js') }}"></script>
</head>

<body id="page-top">
   <!-- Page Wrapper -->
   <div id="wrapper">
      @guest
      @else
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
         <!-- Sidebar - Brand -->
         <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
            <div class="sidebar-brand-icon">
               <img class="logo" src="{{ asset(config('myconfig.public_path').'/img/logoceron.svg') }}">

            </div>
            <div class="sidebar-brand-text mx-3" style="padding-top: 5px;">Consultorio</div>
         </a>
         <!-- Divider -->
         <hr class="sidebar-divider my-0">
         <!-- Nav Item - Dashboard -->
         <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/home') }}">
               <i class="fas fa-fw fa-home"></i>
               <span>Inicio</span></a>
         </li>
         @can('Ver usuarios')
         <!-- Divider -->
         <hr class="sidebar-divider">
         <!-- Heading -->
         <div class="sidebar-heading">
            Usuarios
         </div>
         <!-- Nav Item - Pages Collapse Menu -->
         <li class="nav-item {{ Request::is('users') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/users') }}">
               <i class="fas fa-fw fa-user"></i>
               <span>Usuarios</span></a>
         </li>
         @can('Ver roles')
         <li class="nav-item {{ Request::is('roles') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/roles') }}">
               <i class="fas fa-key"></i>
               <span>Roles y permisos</span></a>
         </li>
         @endcan
         @endcan
         <hr class="sidebar-divider">
         <!-- Heading -->
         <div class="sidebar-heading">
            Otros
         </div>
         @can('Ver instituciones')
         <li class="nav-item {{ Request::is('institutions') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/institutions') }}">
               <i class="fas fa-building"></i>
               <span>Instituciones</span></a>
         </li>
         @endcan
         @can('Ver pacientes')
         <li class="nav-item {{ Request::is('patients') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/patients') }}">
               <i class="fas fa-address-book"></i>
               <span>Pacientes</span></a>
         </li>
         @endcan
         <!-- Divider -->
         <hr class="sidebar-divider d-none d-md-block">
      </ul>
      @endguest
      <!-- End of Sidebar -->
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
         <!-- Main Content -->
         <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
               <!-- Sidebar Toggle (Topbar) -->
               <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
               </button>
               <!-- Topbar Navbar -->
               <ul class="navbar-nav ml-auto">
                  <!-- Nav Item - User Information -->
                  <!-- Authentication Links -->
                  @guest
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  @else
                  <li class="nav-item dropdown no-arrow">
                     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600"> {{ Auth::user()->name }} </span>
                        <img class="img-profile rounded-circle" src="{{ asset(config('myconfig.public_path').'/img/user.png') }}">
                     </a>
                     <!-- Dropdown - User Information -->
                     <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                           <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                           Cerrar sesión
                        </a>
                     </div>
                  </li>
                  @endguest
               </ul>
            </nav>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <main class="py-4">
               @yield('content')
            </main>
            <!-- End of Main Content -->
         </div>
         <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
         <i class="fas fa-angle-up"></i>
      </a>
      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body">Haz click en "Cerrar Sesión" si deseas terminar tu sesión actual.</div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                  <a class="btn btn-danger" href="#" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                     Cerrar Sesión
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                  </form>
                  </form>
               </div>
            </div>
         </div>
      </div>

</body>

</html>