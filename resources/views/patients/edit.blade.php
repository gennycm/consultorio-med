<!-- create.blade.php -->
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
        <h1 class="h3 mb-0 text-gray-800">Crear Paciente</h1>
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


    {!! Form::model($patient, ['method' => 'PATCH','route' => ['patients.update', $patient->id]]) !!}
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h5>Datos personales</h5>
            <hr>
        </div>
    </div>
    <div class="row" style="margin-bottom: 40px;">
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Nombre/s:</strong>
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <!-- <small class="text-danger">{{ $errors->first('name') }}</small> -->
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Apellido Paterno:</strong>
                {!! Form::text('first_lastname', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Apellido materno:</strong>
                {!! Form::text('second_lastname', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Celular:</strong>
                {!! Form::text('cellphone', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Correo electrónico:</strong>
                {!! Form::text('email', null, array('class' => 'form-control')) !!}
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
        <div class="col-xs-12 col-sm-3 col-md-4">
            <div class="form-group">
                <strong>Calle:</strong>
                {!! Form::text('street', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-4">
            <div class="form-group">
                <strong>Número:</strong>
                {!! Form::text('number', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Cruzamiento 1:</strong>
                {!! Form::text('crossing_1', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Cruzamiento 2:</strong>
                {!! Form::text('crossing_2', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Nombre de la calle:</strong>
                {!! Form::text('street_name', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Código postal:</strong>
                {!! Form::text('postal_code', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Ciudad:</strong>
                {!! Form::text('city', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Estado:</strong>
                {!! Form::text('state', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>País:</strong>
                {!! Form::text('country', null, array('class' => 'form-control')) !!}
            </div>
        </div>



    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h5>Facturación</h5>
            <hr>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>RFC:</strong>
                {!! Form::text('RFC', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-2 col-md-2">
            <div class="form-group">
                <label class="personas_label">{{ Form::radio('personas', 'pfisica', $patient->p_phys == 0? true:false, array('class' => 'form-check-input')) }}
                    Persona física</label>
                {!! Form::text('p_phys', null, array('class' => 'form-control', 'hidden'=>'true')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-2 col-md-2">

            <div class="form-group">
                <label class="personas_label">{{ Form::radio('personas', 'pmoral', $patient->p_moral == 0? true:false, array('class' => 'form-check-input')) }}
                    Persona moral</label>
                {!! Form::text('p_moral', null, array('class' => 'form-control', 'hidden'=>'true')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Razón Social:</strong>
                {!! Form::text('trade_name', null, array('class' => 'form-control', 'disabled'=>'true')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-2 col-md-2">

            <div class="form-group">
                <label class="personas_label">{{ Form::checkbox('is_surrogate_check',null, $patient->is_surrogate == 0? true:false, array('class' => 'form-check-input')) }}
                    ¿Es subrogado?</label>
                {!! Form::text('is_surrogate', null, array('class' => 'form-control', 'hidden'=>'true')) !!}

            </div>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong>Relación a otra institución:</strong>
                {!! Form::select('surrogate_id', $institutions,$surrogate_id, array('id'=>'surrogate_id', 'class' => 'form-control', $patient->is_surrogate == 0? '':'disabled')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-bottom: 80px;">
            <button type="submit" class="btn btn-success float-right">Guardar</button>
            <a class="btn btn-secondary float-right" href="{{ URL::previous() }}" role="button" style="margin-right:10px">Cancelar</a>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection
<script src="{{ asset(config('myconfig.public_path').'/vendor/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('input[type=radio][name="personas"]').change(function() {
            var val = $('input[type=radio][name="personas"]:checked').val();
            if (val === 'pfisica') {
                $('input[type=text][name="p_phys"]').val("0");
                $('input[type=text][name="p_moral"]').val("1");
                $('input[type=text][name="trade_name"]').prop("disabled", true);
            } else { // persona mora
                $('input[type=text][name="p_phys"]').val("1");
                $('input[type=text][name="p_moral"]').val("0");
                $('input[type=text][name="trade_name"]').prop("disabled", false);
            }
        });

        if ($('input[type="checkbox"][name="is_surrogate_check"]').is(":checked")) {
            // it is checked
        }

        $('input[type="checkbox"][name="is_surrogate_check"]').change(function() {
            if ($('input[type="checkbox"][name="is_surrogate_check"]').is(":checked")) {
                // it is checked
                $('select[name="surrogate_id"]').prop("disabled", false);
                $('input[type=text][name="is_surrogate"]').val("0");

            } else {
                $('select[name="surrogate_id"]').prop("disabled", true);
                $('input[type=text][name="is_surrogate"]').val("1");
                $('#surrogate_id').val("1"); //Ninguna
            }

            var id = $(this).val(); // this gives me null
            if (id != null) {
                //do other things
                console.log("id", id);
            }

        });
    });
</script>