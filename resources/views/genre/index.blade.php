@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
@if (Auth::user() && Auth::user()->role === '1')
<div class="container">
  <p></p>
  <a href="{{route('genre.create')}}" class="btn btn-primary btn-lg " role="button" aria-disabled="true" style="float: right;">Add Genre</a>
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
        <th scope="col">Genre</th>
       <th scope="col">Action</th>
       
      </tr>
    </thead>
    <tbody>
        @foreach($genres as $genre)
       <tr>
            <td>{{$genre->genre_name}}</td>
            <td><a href="{{route('genre.edit',$genre->id)}}"><i class="fas fa-edit"></i></a>
            <form action="{{route('genre.destroy',$genre->id)}}" method="POST" style = "display:inline-block">
                @method('DELETE')
                @csrf
                <button type="submit">
                    <i class="fa-solid fa-trash" style="color:red"></i>
                </button>
            </form>
          </td>
        </tr> 
       @endforeach
    </tbody>
  </table>
          </div>
      </div>
  </div>
</div>
@else
<p>Access denied. You must be an admin to view this page.</p>
@endif
@endsection