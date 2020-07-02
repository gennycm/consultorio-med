<!-- show.blade.php -->
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
      <div class="col-xs-10 col-sm-10 col-md-10">
         <h1 class="h3 mb-0 text-gray-800"> <strong>Paciente:</strong> {{ $patient->name }} {{ $patient->first_lastname }} {{ $patient->second_lastname }}</h1>
      </div>
      <div class="col-xs-2 col-sm-2 col-md-2">
         <a class="btn btn-secondary float-right" href="{{ URL::previous() }}" role="button" style="margin-right:10px">Regresar a Pacientes</a>
      </div>
   </div>
   <!-- Content Row -->
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
         <h5>Datos personales</h5>
         <hr>
      </div>
   </div>
   <div class="row" style="margin-bottom: 40px;">
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Nombre/s:</strong>
            {{ $patient->name }} {{ $patient->first_lastname }} {{ $patient->second_lastname }}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Correo electrónico:</strong>
            {{ $patient->email }}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Celular:</strong>
            {{ $patient->cellphone }}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Fecha de nacimiento:</strong>
            {{date('d-M-Y', strtotime($patient->birthdate)) }}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Edad:</strong>
            {{\Carbon\Carbon::parse($patient->birthdate)->age}}

         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
         <h5>Dirección</h5>
         <hr>
      </div>
   </div>
   <div class="row" style="margin-bottom: 40px;">
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Sucursal:</strong>
            {{ $patient->branch }}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Dirección:</strong>
            Calle {{ $patient->street }}
            Num. {{ $patient->number }}
            por {{ $patient->crossing_1 }}
            {{ $patient->street_name }}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Código Postal:</strong>
            {{ $patient->postal_code }}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Ciudad:</strong>
            {{ $patient->city }}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Estado:</strong>
            {{ $patient->state }}
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>País:</strong>
            {{ $patient->country }}
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
         <h5>Facturación</h5>
         <hr>
      </div>
   </div>
   <div class="row" style="margin-bottom: 40px;">
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>RFC:</strong>
            <span style="text-transform: uppercase;">{{ $patient->RFC }}</span>
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Persona:</strong>
            @if ($patient->p_phys === 0)
            Física
            @elseif ($patient->p_moral === 0)
            Moral
            @endif
         </div>
      </div>
      @if ($patient->p_moral === 0)
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Razón social:</strong>
            {{ $patient->trade_name }}
         </div>
      </div>
      @endif
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>¿Es subrogado?:</strong>
            @if ($patient->is_surrogate === 0)
            Sí
            @else
            No
            @endif
         </div>
      </div>
      @if ($patient->is_surrogate === 0)
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Insitutición:</strong>
            {{ $surrogate->name }}
         </div>
      </div>
      @endif
   </div>
</div>
@endsection