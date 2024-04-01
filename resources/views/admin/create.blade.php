@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
  {!! Form::open(['url' => '/user']) !!}
  <div class="form-group row">
    <label for="name">Name</label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
  </div>
    <div class="form-group row">
    <label for="email">Email</label>
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group row">
    <label for="password">Password</label>
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
  <div class="form-group row">
    <label for="role">Role</label>
    {!! Form::select('role', ['1' => 'Librarian', '0' => 'Student'], null, ['class' => 'form-control']) !!}
  </div>
  {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}
  {!! Form::close() !!}

</div>
</div>
</div>

@endsection