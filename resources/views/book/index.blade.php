@extends('layout.master')
@section('title')
  BookWise
@endsection

@section('content')
@if (Auth::user() && Auth::user()->role === '1')
<div class="container">
  <p></p>
  <a href="{{route('book.create')}}" class="btn btn-primary btn-lg " role="button" aria-disabled="true" style="float: right;">Add Book</a>
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
<table class="table">
    <thead>
      <tr>
        <th scope="col">Book Name</th>
         <th scope="col">Image</th>
         <th scope="col">Genre</th>
        <th scope="col">Author Name</th>
        <th scope="col">Date Released</th>
        <th scope="col">Action</th>
        </ul>
      </tr>
      {{-- <h2>Top 10 most borrowed books:</h2>
      <ul>
          @foreach ($books as $book)
              <li>{{ $book->title }} by {{ $book->author }} ({{ $book->nums }} times)</li>
          @endforeach
      </ul> --}}
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{$book->title}}</td>
            <td><img src="{{url($book->imgpath)}}" alt="" width="50px" height="50px"></td>
            <td>{{$book->genre_name}}</td>
            <td>{{$book->name}}</td>
            <td>{{$book->date_released}}</td>
            <td><a href="{{route('book.edit',$book->id)}}"><i class="fas fa-edit"></i></a>
            <form action="{{route('book.destroy',$book->id)}}" method="POST" style = "display:inline-block">
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