@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
    <form action="{{url('/book')}}"  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
          <label for="title">Book Title</label>
          <input type="text" class="form-control" id="title"  name="title" placeholder="Enter Book Title">
        </div>
        <div class="form-group row">
          <label for="date_released">Date released</label>
          <input type="date" class="form-control" id="date_released" name="date_released">
        </div>
        <div class="form-group row">
          <label for="author name">Author</label>
        <select class="form-select form-control" aria-label="Default select example" name="author_id">
          <option selected>Open this select menu</option>
          @foreach($authors as $author)
            <option value="{{$author->id}}">{{$author->name}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group row">
        <label for="author name">Genre</label>
      <select class="form-select form-control" aria-label="Default select example" name="genre_id">
        <option selected>Open this select menu</option>
        @foreach($genres as $genre)
          <option value="{{$genre->id}}">{{$genre->genre_name}}</option>
        @endforeach
      </select>
    </div>

      <div class="form-group row">
        <label class="form-check-label" for="file">Image</label>
        <input type="file" class="form-control" id="file" name="imgpath" accept='image/*'>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>
</div>
@endsection