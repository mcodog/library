@extends('layout.master')

@section('title')
  New York Sanctuary
@endsection

@section('content')
  {{ Form::model($users, ['route' => ['user.update', $users->id], 'method' => 'PUT']) }}
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
    {!! Form::password('password', ['class' => 'form-control', 'name1' => 'password']) !!}
</div>
  <div class="form-group row">
    <label for="role">Role</label>
    {!! Form::select('role', ['1' => 'Librarian', '0' => 'Student'], null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group row">
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
  </div>
  {!! Form::close() !!}
@endsection
