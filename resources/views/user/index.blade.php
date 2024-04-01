@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
<div class="container">
  <p></p>
  {{-- <a href="{{route('user.create')}}" class="btn btn-primary btn-lg " role="button" aria-disabled="true" style="float: right;"></a> --}}
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
<table class="table">
  {{-- @if (Session::has('message'))
  <div class="alert alert-primary" role="alert">
    {{Session::get('message')}} 
  </div>
  @endif --}}
    <thead>
      <tr>
        <th scope="col">Name</th>
       <th scope="col">Email</th>
       <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
       <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
             <td><a href="{{route('user.edit',$user->id)}}"><i class="fas fa-edit"></i></a>
          </td>
        </tr> 
       @endforeach
    </tbody>
  </table>
          </div>
      </div>
  </div>
</div>
  {{-- {{$artists->links()}} --}}
@endsection