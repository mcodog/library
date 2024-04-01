@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
<div class="container">
  <p></p>
  <a href="{{route('user.create')}}" class="btn btn-primary btn-lg " role="button" aria-disabled="true" style="float: right;">Add Account</a>
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
        <th scope="col">Role</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        @if ($user->id != 1 && $user->email != 'admin@gmail.com')
       <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{ $user->role == 1 ? 'Librarian' : 'Student' }}</td>
            <td><a href="{{route('user.edit',$user->id)}}"><i class="fas fa-edit"></i></a>
            <form action="{{route('user.destroy',$user->id)}}" method="POST" style = "display:inline-block">
                @method('DELETE')
                @csrf
                <button type="submit">
                    <i class="fa-solid fa-trash" style="color:red"></i>
                </button>
            </form>
          </td>
        </tr> 
        @endif
       @endforeach
    </tbody>
  </table>
          </div>
      </div>
  </div>
</div>
  {{-- {{$artists->links()}} --}}
@endsection