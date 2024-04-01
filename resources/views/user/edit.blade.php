@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
  {{-- @foreach ($album as $al =>$key)
    {{dump($key->id)}}
  @endforeach --}}
{{-- {{dd($album)}} --}}
<div class="container">
  <div class="row justify-content-center">
    {{ Form::model($users, ['route' => ['user.update', $users->id], 'method'=> 'PUT']) }}
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
        {!! Form::password('password', ['class' => 'form-control', 'name' => 'password']) !!}
      </div>
      {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>
@endsection
