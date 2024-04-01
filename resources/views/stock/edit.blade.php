@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')

<div class="container">
  <div class="container">
    <div class="row justify-content-center">
    {{Form::model($stock, ['route' => ['stocks.update', $stock->id], 'method'=> 'PUT'])}}
    <div class="form-group row">
      <label for="book_id">Book Name</label>
      {!! Form::text('book_name', $stock->book->title, ['class' => 'form-control', 'readonly']) !!}
      {!! Form::hidden('book_id', $stock->book_id) !!} <!-- Include a hidden field to retain the book_id value -->
    </div>
    <div class="form-group row">
      <label for="stock">Stock</label>
      {!! Form::text('stock', $stock->stock, ['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>
</div>
</div>
@endsection
