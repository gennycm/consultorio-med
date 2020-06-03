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
        <h1 class="h3 mb-0 text-gray-800">Crear rol</h1>
    </div>
    <!-- Content Row -->


    @if (count($errors) > 0)
    <div class="alert alert-danger  alert-dismissible fade show">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Oops!</strong> Hubo un problema con los datos que proporcionaste.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permisos:</strong>
                <br />
                @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                    {{ $value->name }}</label>
                <br />
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-success float-right">Guardar</button>
            <a class="btn btn-secondary float-right" href="{{ URL::previous() }}" role="button" style="margin-right:10px">Cancelar</a>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection