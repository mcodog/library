@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
<div class="container">
  <div class="container">
    <div class="row justify-content-center">
    {{Form::model($author, ['route' => ['user.update', $author ->id], 'method'=> 'PUT'])}}
    <div class="form-group row">
      <label for="name">Name</label>
      {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group row">
      <label for="gender">Gender</label>
      {!! Form::text('gender',null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group row">
      <label for="age">Age</label>
      {!! Form::text('age',null, ['class' => 'form-control']) !!}
    </div>
  
    {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>
</div>
</div>
@endsection