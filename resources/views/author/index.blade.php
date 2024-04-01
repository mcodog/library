@extends('layout.master')
@section('title')
    New York Sanctuary
@endsection

@section('content')
@if (Auth::user() && Auth::user()->role === '1')
    <div class="container">
        <p></p>
        <a href="{{ route('author.create') }}" class="btn btn-primary btn-lg " role="button" aria-disabled="true"
            style="float: right;">Add Author</a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Author Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Age</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $author)
                                <tr>
                                    <td>{{ $author->name }}</td>
                                    <td>{{ $author->gender }}</td>
                                    <td>{{ $author->age }}</td>
                                    <td>
                                        <a href="{{ route('author.edit', $author->id) }}"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('author.destroy', $author->id) }}" method="POST"
                                            style="display:inline-block">
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
