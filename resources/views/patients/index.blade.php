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
   <div class="row">
      <div class="col-md-10">
         <div class="form-group">
            <div class="row">
               <div class="col-md-12 col-sm-11">
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" id="search-field" name="search" placeholder="Nombre" aria-label="Introduce el nombre de la institución" autocomplete="off">
                     <div class="input-group-append">
                        <button id="search" class="btn btn-dark" type="button">Buscar</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-2">
         <button id="clean_search_results" class="btn btn-outline-dark float-right">Limpiar resultados</button>
      </div>
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
            <button class="btn btn-danger" data-patid="{{$patient->id}}" data-toggle="modal" data-target="#deletePatModal">Eliminar</button>
            @endcan
         </td>
      </tr>
      @endforeach
   </table>
   {!! $patients->render() !!}
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deletePatModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLongTitle">Confirmación de eliminación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('patients.destroy','test')}}" method="post" style=" margin-block-end: 0; ">
            {{method_field('delete')}}
            {{csrf_field()}}
            <div class="modal-body text-center">
               <span id="confirmation-message">
                  ¿Seguro que quieres eliminar este paciente?
               </span>
               <input type="hidden" name="patient_id" id="patient_id" value="">

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
               <button type="submit" class="btn btn-danger">Sí, Eliminar</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

<script src="{{ asset(config('myconfig.public_path').'/vendor/jquery/jquery.min.js') }}"></script>
<script>
   $(document).ready(function() {
      $("#search").click(function() {
         search('/search-patients', '#patients_table');
      });

      $("#clean_search_results").click(function() {
         clean_search_results('/clean-patients', '#patients_table');
      });

      $('#deletePatModal').on('show.bs.modal', function(event) {
         var button = $(event.relatedTarget);
         var patientId = button.data('patid');
         var modal = $(this);
         modal.find('.modal-body #patient_id').val(patientId);
      });
   });
</script>