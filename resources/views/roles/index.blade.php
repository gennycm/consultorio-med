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
   <div class="row mb-4">
      <div class="col-md-9">
         <h1 class="h3 mb-0 text-gray-800">Roles</h1>
      </div>
      @can('Crear roles')
      <div class="col-md-3 text-right">
         <a class="btn btn-success btn-icon-split" href="{{route ('roles.create')}}">
            <span class="icon text-white-50">
               <i class="fas fa-plus" style="margin-top: 4.5px;"></i>
            </span>
            <span class="text">Agregar Rol</span>
         </a>
      </div>
      @endcan
   </div>

   <!-- Content Row -->
   @if ($message = Session::get('success'))
   <div class="alert alert-success alert-dismissible fade show">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <p>{{ $message }}</p>
   </div>
   @endif
    <table class="table table-striped">
      <tr>
         <th>Nombre</th>
         <th width="280px">Acciones</th>
      </tr>
      @foreach ($roles as $key => $role)
      <tr>
         <td>{{ $role->name }}</td>
         <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Ver</a>
            @can('Editar roles')
            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
            @endcan
            @can('Eliminar roles')
            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endcan
         </td>
      </tr>
      @endforeach
   </table>
   {!! $roles->render() !!}
</div>
@endsection
