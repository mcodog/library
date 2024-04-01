@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
  {!! Form::open(['url' => '/stocks']) !!}
  <div class="form-group row">
    <label for="book_id">Book</label>
    {!! Form::select('book_id', $books->pluck('title', 'id'), null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group row">
    <label for="stock">Stocks</label>
    {!! Form::text('stock',null, ['class' => 'form-control']) !!}
  </div>
  {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}
  {!! Form::close() !!}
</div>
</div>
</div>

@endsection