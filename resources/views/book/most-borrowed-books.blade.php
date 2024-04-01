@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
<h2>Top 10 most borrowed books:</h2>
<ul>
    @foreach ($books as $book)
        <li>{{ $book->title }} by {{ $book->author }} ({{ $book->nums }} times)</li>
    @endforeach
</ul>
@endsection