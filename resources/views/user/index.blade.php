<!-- index.blade.php -->
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
   <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
</div>
<!-- Content Row -->
<div class="row">
   <div class="col-md-12">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
         {{ session('status') }}
      </div>
      @endif
   </div>
</div>
<div class="row">
<div class="col-md-12">
   <div class="uper">
      @if(session()->get('success'))
      <div class="alert alert-success">
         {{ session()->get('success') }}  
      </div>
      <br />
      @endif
      <table class="table table-striped">
         <thead>
            <tr>
               <td>ID</td>
               <td>Name</td>
               <td>Email</td>
               <td colspan="2">Action</td>
            </tr>
         </thead>
         <tbody>
            @foreach($users as $user)
            <tr>
               <td>{{$user->id}}</td>
               <td>{{$user->name}}</td>
               <td>{{$user->email}}</td>
               <td><a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a></td>
               <td>
                  <form action="{{ route('users.destroy', $user->id)}}" method="post">
                     @csrf
                     @method('DELETE')
                     <button class="btn btn-danger" type="submit">Delete</button>
                  </form>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
      <div>
      </div>
   </div>
</div>
@endsection
