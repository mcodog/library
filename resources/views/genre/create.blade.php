@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
  {!! Form::open(['url' => '/genre']) !!}
  <div class="form-group row">
    <label for="genre_name">Genre Name</label>
    {!! Form::text('genre_name', null, ['class' => 'form-control']) !!}
  </div>
  {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}
  {!! Form::close() !!}

</div>
</div>
</div>

@endsection