<!-- index.blade.php -->
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
   <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
    <div class="col-md-2">
        <a  class="btn btn-success btn-icon-split" href="{{route ('users.create')}}">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Agregar Usuario</span>
        
        </a>
    </div>
</div>
<!-- Content Row -->
<div class="row">
   <div class="col-md-12">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
         {{ session('status') }}
      </div>
      @endif
   </div>
</div>
<div class="row">
<div class="col-md-12">
   <div class="uper">
      @if(session()->get('success'))
      <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         {{ session()->get('success') }}  
      </div>
      <br />
      @endif
      <table class="table table-striped">
         <thead>
            <tr>
               <td>Nombre</td>
               <td>Correo</td>
               <td colspan="2">Acciones</td>
            </tr>
         </thead>
         <tbody>
            @foreach($users as $user)
            <tr>
               <td>{{$user->name}}</td>
               <td>{{$user->email}}</td>
               <td><a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Editar</a></td>
               <td>
                  <form action="{{ route('users.destroy', $user->id)}}" method="post">
                     @csrf
                     @method('DELETE')
                     <button class="btn btn-danger" type="submit">Borrar</button>
                  </form>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
      <div>
      </div>
   </div>
</div>
@endsection
