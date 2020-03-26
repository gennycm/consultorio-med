<!-- edit.blade.php -->
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
      <h1 class="h3 mb-0 text-gray-800">Editar Usuario</h1>
   </div>
   <!-- Content Row -->
   @if (count($errors) > 0)
   <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
         @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
   @endif
   {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id], 'autocomplete' => 'off']) !!}
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Nombre:</strong>
            {!! Form::text('name', null, array('class' => 'form-control')) !!}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Correo electrónico:</strong>
            {!! Form::text('email', null, array('class' => 'form-control')) !!}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Contraseña:</strong>
            {!! Form::password('password', array('class' => 'form-control', 'id' => 'password')) !!}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Confirmar Contraseña:</strong>
            {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Roles:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control')) !!}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
         <button type="submit" class="btn btn-primary float-right">Guardar cambios</button>
      </div>
   </div>
   {!! Form::close() !!}
</div>
@endsection
