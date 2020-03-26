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
    @can('Crear usuarios')
      <div class="col-md-2">
         <a  class="btn btn-success btn-icon-split" href="{{route ('users.create')}}">
         <span class="icon text-white-50">
         <i class="fas fa-plus"></i>
         </span>
         <span class="text">Agregar Usuario</span>
         </a>
      </div>
    @endcan

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
         @if ($message = Session::get('success'))
         <div class="alert alert-success  alert-dismissible fade show">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>{{ $message }}</p>
         </div>
         @endif
         <table class="table table-striped">
            <tr>
               <th>Nombre</th>
               <th>Correo Electrónico</th>
               <th>Roles</th>
               <th width="280px">Acciones</th>
            </tr>
            @foreach ($data as $key => $user)
            <tr>
               <td>{{ $user->name }}</td>
               <td>{{ $user->email }}</td>
               <td>
                  @if(!empty($user->getRoleNames()))
                  @foreach($user->getRoleNames() as $v)
                  <label class="badge badge-success">{{ $v }}</label>
                  @endforeach
                  @endif
               </td>
               <td>
                  <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Ver</a>
                  @can('Editar usuarios')
                  <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>
                  @endcan
                  @can('Eliminar usuarios')
                  {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                  {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
                  @endcan
               </td>
            </tr>
            @endforeach
         </table>
         {!! $data->render() !!}
      </div>
   </div>
</div>
@endsection
