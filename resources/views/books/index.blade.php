@extends('layouts.layout')
@section('content')
<div class="container d-flex  justify-content-center"> 
<h1 class="d-flex  align-items-center">Bookstore</h1>
</div>
<div class="d-flex justify-content-between gap-4">
  <div class="d-flex gap-4">
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3 float-left" style="margin-bottom: 6px">Add Book</a>
    <a href="{{ route('get-pdf') }}" class="btn btn-primary mb-3 float-left" style="margin-bottom: 6px">Download PDF</a>
  </div>

  <form method="POST" action="{{route('books.search')}} " class="d-flex gap-4 mb-3">
    @csrf
    <input type="text" name="search" class="form-control" placeholder="Search">
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
</div>

<table class="table table-striped table-bordered table-responsive-xl">
  <thead>
    <tr class="bg-dark text-white">
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Publisher</th>
      <th scope="col">Isbn</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody id="myTable" class="border">
    @foreach($books as $book)
    <tr>
      <th scope="row">{{$book->id}}</th>
      <td>{{$book->title}}</td>
      <td>{{$book->author}}</td>
      <td>{{$book->publisher}}</td>
      <td>{{$book->isbn}}</td>
      <td>{{$book->price}}</td>
      <td>
        <div class="d-flex justify-content-end gap-2">
          <a href="{{route('books.edit', $book->id)}}" class="btn btn-primary">Edit</a>
        <form method="POST" action="{{route('books.destroy', $book->id)}}" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$books->links()}}

@endsection
