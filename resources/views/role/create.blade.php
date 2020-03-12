<!-- create.blade.php -->
@extends('layouts.app')
@section('content')
<style>
   .uper {
   margin-top: 40px;
   }
</style>
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Agregar Rol</h1>
   </div>
   <!-- Content Row -->
   <div class="">
      <div class="">
         @if ($errors->any())
         <div class="alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
         <br />
         @endif
         <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="form-group row">
               <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
               <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row">
              <h5>Permisos</h5>
            </div>
            <div class="form-group row">
               <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
               <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group row">
               <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar contraseña</label>
               <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
               </div>
            </div>
            <div class="form-group row mb-0">
               <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary float-right">
                  Guardar
                  </button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
</div>
@endsection
