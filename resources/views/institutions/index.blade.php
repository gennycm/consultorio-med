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
         <h1 class="h3 mb-0 text-gray-800">Instituciones</h1>
      </div>
      @can('Crear instituciones')
      <div class="col-md-3 text-right">
         <a class="btn btn-success btn-icon-split" href="{{route ('institutions.create')}}">
            <span class="icon text-white-50">
               <i class="fas fa-plus" style="margin-top: 4.5px;"></i>
            </span>
            <span class="text">Agregar Institución</span>
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
      <!--
      <div class="col-md-4">
         <div class="row">
            <div class="col-md-12" style="text-align: right">
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <label class="_label input-group-text" for="select-change">Filtrar:</label>
                  </div>
                  <select class="custom-select" id="select-change">
                     <option selected disabled>Selecciona una institución relacionada</option>
                     @foreach ($parent_institutions as $key => $parent_institution )
                     <option value="{{$parent_institution->id}}">{{$parent_institution->name}}</option>
                     @endforeach
                  </select>
               </div>
            </div>
         </div>
      </div>-->
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
   <div id="institutions_table">
      @include('partials.institutions_table')
   </div>


</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteInstModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLongTitle">Confirmación de eliminación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('institutions.destroy','test')}}" method="post" style=" margin-block-end: 0; ">
            {{method_field('delete')}}
            {{csrf_field()}}
            <div class="modal-body text-center">
               <span id="confirmation-message">
                  ¿Seguro que quieres eliminar esta institución?
               </span>
               <input type="hidden" name="institution_id" id="institution_id" value="">

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
         search('/search-institutions', '#institutions_table');
      });

      $("#select-change").change(function() {
         filter('/filter-institutions', '#institutions_table');
      });

      $("#clean_search_results").click(function() {
         clean_search_results('/clean-institutions', '#institutions_table');
      });

      $('#deleteInstModal').on('show.bs.modal', function(event) {
         var button = $(event.relatedTarget);
         var institutionId = button.data('instid');
         var hasPatients = button.data('patients');
         var modal = $(this);
         modal.find('.modal-body #institution_id').val(institutionId);
         if (hasPatients == 1) {
            modal.find('.modal-body #confirmation-message').append("<br/>Esta institución tiene pacientes subrogados. Al eliminarla, será desvinculada de los pacientes.");
         }
      });

      $('#deleteInstModal').on('hidden.bs.modal', function(event) {
         $('#confirmation-message').text("¿Seguro que quieres eliminar este usuario?");
      });
   });
</script>