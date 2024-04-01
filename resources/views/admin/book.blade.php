@extends('layout.master')
    @if(Auth::user()->role == '1')
        @section('content')
        <div class="row">
            @include('layout.flash-messages')
            <div class="col-md-8 col-md-offset-2">
                <a href="{{route('book.create')}}" class="btn btn-primary btn-lg " role="button" aria-disabled="true" style="float: right;">Add Book</a>

                <h1>All Books</h1>
                <hr>
            
                {{ $dataTable->table() }}
                
            </div>
        </div>
        @endsection
        @push('scripts')
            {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        @endpush
    @else
        @section('content')
        <h1>Page Restricted</h1>
        @endsection

    @endif

