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
            <h1 class="h3 mb-0 text-gray-800"> <strong>Rol:</strong> {{ $role->name }}</h1>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            <a class="btn btn-secondary float-right" href="{{ URL::previous() }}" role="button" style="margin-right:10px">Regresar a Roles</a>
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
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permisos:</strong>
                <ul>
                    @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                    <li><label class="label label-success">{{ $v->name }}</label></li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection