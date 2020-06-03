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
   <div class="row">
      <div class="col-md-10">
         <div class="form-group">
            <div class="row">
               <div class="col-md-12 col-sm-11">
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" id="search-field" name="search" placeholder="Nombre" aria-label="Nombre" autocomplete="off">
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
   <div id="roles_table">
      @include('partials.roles_table')
   </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="deleteRolesModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLongTitle">Confirmación de eliminación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('roles.destroy','test')}}" method="post" style=" margin-block-end: 0; ">
            {{method_field('delete')}}
            {{csrf_field()}}
            <div class="modal-body text-center">
               <span id="confirmation-message">
                  ¿Seguro que quieres eliminar este rol?
               </span>
               <input type="hidden" name="role_id" id="role_id" value="">

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
         search('/search-roles', '#roles_table');
      });

      $("#clean_search_results").click(function() {
         clean_search_results('/clean-roles', '#roles_table');
      });

      $('#deleteRolesModal').on('show.bs.modal', function(event) {
         var button = $(event.relatedTarget);
         var roleId = button.data('roleid');
         var hasUsers = button.data('users');
         var modal = $(this);
         modal.find('.modal-body #role_id').val(roleId);
         if (hasUsers == 1) {
            modal.find('.modal-body #confirmation-message').append("<br/>Existen usuarios con este rol asignado. Al eliminarlo, dichos usuarios se " +
               "quedarán sin rol por lo que perderán sus permisos.");
         }
      });

      $('#deleteRolesModal').on('hidden.bs.modal', function(event) {
         $('#confirmation-message').text("¿Seguro que quieres eliminar este rol?");
      });
   });
</script>