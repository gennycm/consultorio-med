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
      <h1 class="h3 mb-0 text-gray-800">Ver Rol</h1>
   </div>
   <!-- Content Row -->
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
