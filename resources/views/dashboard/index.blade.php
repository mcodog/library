@extends('layout.master')

@section('title')
  New York Sanctuary
@endsection

@section('content')
<br>
<div class="container">
  <div class="row">
    @foreach ($books->chunk(2) as $book)
      @foreach ($book as $item)
        <div class="col-sm-6 col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top" src="{{ $item->imgpath }}" alt="Book Cover" style="height: 450px; width: 100%; display: block;">
            <div class="card-body">
              <h4 class="card-title">{{ $item->title }}</h4>
              <p class="card-text"><strong>Genre: </strong>{{ $item->genre_name }}</p>
              <p class="card-text"><strong>Author: </strong>{{ $item->name }}</p>
              <p class="card-text"> <strong>Date Released:</strong> {{ $item->date_released }}</p>
              <p class="card-text"> <strong>Stocks:</strong> {{ $item->stock }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{ route('item.addcheckout', ['id'=>$item->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="fa fa-book" style="font-size:13px;color:red"></i> Add to Checkout</a>
                  @if(Session::has('checkout') && isset(Session::get('checkout')[$item->id]))
                    <span class="badge badge-pill badge-primary">{{ Session::get('checkout')[$item->id]['quantity'] }}</span>
                  @endif
                  {{-- <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fas fa-info"></i> More Info</a> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @endforeach
  </div>
</div>
@endsection
