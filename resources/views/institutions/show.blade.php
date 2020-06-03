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
        <div class="col-xs-10 col-sm-10 col-md-10">
            <h1 class="h3 mb-0 text-gray-800"> <strong>Institución:</strong> {{ $institution->name }}</h1>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            <a class="btn btn-secondary float-right" href="{{ URL::previous() }}" role="button" style="margin-right:10px">Regresar a Instituciones</a>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
         <h5>Datos</h5>
         <hr>
      </div>
   </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {{ $institution->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Código:</strong>
                {{ $institution->code }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Número de contrato:</strong>
                {{ $institution->num_contract }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>RFC:</strong>
                {{ $institution->rfc }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Uso de CFDI:</strong>
                {{ $institution->cfdi }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Razón social:</strong>
                {{ $institution->trade_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Relación a otra institución:</strong>
                {{ $related_institution->name }}
            </div>
        </div>

    </div>
</div>
@endsection