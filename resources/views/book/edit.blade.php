@extends('layout.master')
@section('title')
  New York Sanctuary
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
    <form action="{{route('book.update', $book->id)}}"  method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group row">
          <label for="title">Book Title</label>
          <input type="text" class="form-control" name="title" placeholder="Enter album Name" value="{{$book->title}}">
         
        </div>
        <div class="form-group row">
          <label for="date_released">Date Released</label>
          <input type="date" class="form-control" name="date_released" value="{{$book->date_released}}">
        </div>

        <div class="form-group row">
          <label for="name">Author Name</label>
          <select class="form-select form-control" aria-label="Default select example" name="author_id">
            <option selected value="{{$book->author_id}}">{{$book->name}}</option>
            @foreach($authors as $author)
              <option value="{{$author->id}}">{{$author->name}}</option>
            @endforeach
          </select>
        </div>
        
        <div class="form-group row">
          <label for="name">Genre</label>
          <select class="form-select form-control" aria-label="Default select example" name="genre_id">
            <option selected value="{{$book->genre_id}}">{{$book->genre_name}}</option>
            @foreach($genres as $genre)
              <option value="{{$genre->id}}">{{$genre->genre_name}}</option>
            @endforeach
          </select>
        </div>

          <div class="form-group row">
            <label class="form-check-label " for="file">Image</label>
          <input type="file" class="form-control"  id="file" name="imgpath" accept='image/*'>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>
</div>
@endsection
