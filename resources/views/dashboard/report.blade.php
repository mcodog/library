@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
    <div class="container">
        <h1>Most Borrowed Books</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Total Borrowed</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mostBorrowed as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->total_borrow }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
