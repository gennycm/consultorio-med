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
         <h1 class="h3 mb-0 text-gray-800">Pacientes</h1>
      </div>
      @can('Crear pacientes')
      <div class="col-md-3 text-right">
         <a class="btn btn-success btn-icon-split" href="{{route ('patients.create')}}">
            <span class="icon text-white-50">
               <i class="fas fa-plus" style="margin-top: 4.5px;"></i>
            </span>
            <span class="text">Agregar Paciente</span>
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
         <th>Celular</th>
         <th>Correo</th>
         <th>Persona</th>
         <th>Subrogado</th>
         <th width="280px">Acciones</th>
      </tr>
      @foreach ($patients as $key => $patient)
      <tr>
         <td>{{ $patient->name }} {{ $patient->first_lastname }} {{ $patient->second_lastname }}</td>
         <td>{{ $patient->cellphone }}</td>
         <td>{{ $patient->email }}</td>
         <td>
            @if ($patient->p_phys === 0)
            Física
            @elseif ($patient->p_moral === 0)
            Moral
            @endif
         </td>
         <td>
            @if ($patient->is_surrogate === 0)
            Sí
            @else
            No
            @endif
         </td>
         <td>
            <a class="btn btn-info" href="{{ route('patients.show',$patient->id) }}">Ver</a>
            @can('Editar pacientes')
            <a class="btn btn-primary" href="{{ route('patients.edit',$patient->id) }}">Editar</a>
            @endcan
            @can('Eliminar pacientes')
            {!! Form::open(['method' => 'DELETE','route' => ['patients.destroy', $patient->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endcan
         </td>
      </tr>
      @endforeach
   </table>
   {!! $patients->render() !!}
</div>
@endsection