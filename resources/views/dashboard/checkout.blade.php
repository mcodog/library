@extends('layout.master')

@section('title')
    New York Sanctuary
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif((session('error')))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
    @if(Session::has('checkout'))
        <div class="row">
            <div class="col-sm-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Return Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($checkout as $item)
                            <tr>
                                <td>{{ $item['title'] }}</td>
                                <td><img src="{{ asset($item['img_path']) }}" alt="{{ $item['title'] }}" style="max-height: 100px;"></td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>
                                    <input type="date" class="form-control" id="return_date" name="return_date" min="{{ Carbon\Carbon::now()->addDays(1)->format('Y-m-d') }}" max="{{ Carbon\Carbon::now()->addDays(30)->format('Y-m-d') }}" value="{{ $item['due_date'] }}" required>
                                </td>                                
                                <td>
                                    <a href="{{ route('checkout.remove', $item['id']) }}" class="btn btn-danger">Remove from checkout</a>
                                    <a href="{{ route('reduce', $item['id']) }}" class="btn btn-danger">Reduce Quantity by 1</a>
                                </td>                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>No Items in Cart!</h2>
            </div>
        </div>
    @endif
@endsection
