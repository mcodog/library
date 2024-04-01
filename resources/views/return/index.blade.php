@extends('layout.master')

@section('title')
  New York Sanctuary
@endsection

@section('content')
<div class="container">
  <p></p>
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <table class="table">
                  <thead>
                      <tr>
                          <th scope="col">Book Name</th>
                          <th scope="col">Image</th>
                          <th scope="col">Due Date</th>
                          <th scope="col">Penalty</th>
                          <th scope="col">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($books as $book)
                      <tr>
                          <td>{{ $book->title }}</td>
                          <td><img src="{{ url($book->imgpath) }}" alt="" width="50px" height="50px"></td>
                          <td>
                            @foreach($book->borrows as $borrow)
                                @if($borrow->due_date != null)
                                    {{ $borrow->due_date }}
                                @endif
                            @endforeach
                          </td>
                          <td>
                            @if($book->penalty == null)
                                -
                            @else
                                ${{ $book->penalty }}
                            @endif
                          </td>
                          <td>
                            <form action="{{ route('book.restore', $book->id) }}" method="POST" style="display: inline-block;">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </form>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>
@endsection
