@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
    <h1>Search Results for "{{ $query }}"</h1>

    <ul>
        @foreach ($books as $book)
        
        <li><img src="{{url($book->imgpath)}}" alt="" width="150px" height="150px"> - -{{ $book->title }} by {{ $book->author_name }} ({{ $book->genre_name }}) - Released on {{ $book->date_released }}</li>
    @endforeach
    </ul>
@endsection
