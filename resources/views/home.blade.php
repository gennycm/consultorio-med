@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Hola {{ Auth::user()->name }}!</h1>
   </div>
   <!-- Content Row -->
   <div class="row">
      <div class="col-md-8">
         @if (session('status'))
         <div class="alert alert-success" role="alert">
            {{ session('status') }}
         </div>
         @endif
        
      </div>
   </div>
</div>
@endsection
