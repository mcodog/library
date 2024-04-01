@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
@if (Auth::user() && Auth::user()->role === '1')
<div class="container">

  <a href="{{route('stocks.create')}}" class="btn btn-primary btn-lg " role="button" aria-disabled="true" style="float: right;">Add Stock</a>
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
        <th scope="col">Book</th>
        <th scope="col">Stock</th>
      </tr>
    </thead>
    <tbody>
        @foreach($stocks as $stock)
       <tr>
            <td>{{$stock->title}}</td>
            <td>{{$stock->stock}}</td>
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