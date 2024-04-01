@extends('layout.master')
@if(Auth::user()->role == '1')
    @section('content')
    <div class="row">
        @include('layout.flash-messages')
        <div class="col-md-8 col-md-offset-2">
            <a href="{{route('genre.create')}}" class="btn btn-primary btn-lg " role="button" aria-disabled="true" style="float: right;">Add Genre</a>

            <h1>All Genres</h1>
            <hr>
           
            {{$dataTable->table()}}
            {{$dataTable->scripts()}}
        </div>
    </div>
    @endsection
@else
@section('content')
<h1>Page Restricted</h1>
@endsection
@endif
