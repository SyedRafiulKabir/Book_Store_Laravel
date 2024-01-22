@extends('layouts.layout')

@section('content')

<form method="POST" action={{route('books.update', ['book'=>$book])}} >
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{$book->title ? $book->title : old('title')}}" aria-describedby="title">
  </div>
  <div class="mb-3">
    <label for="author" class="form-label">Author</label>
    <input type="author" class="form-control" name="author" value="{{$book->author ? $book->author : old('author')}}"  id="author">
  </div>
  <div class="mb-3">
    <label for="publisher" class="form-label">Publisher</label>
    <input type="publisher" class="form-control" name="publisher" value="{{$book->publisher ? $book->publisher : old('publisher')}}"  id="publisher">
  </div>
  <div class="mb-3">
    <label for="isbn" class="form-label">Isbn</label>
    <input type="isbn" class="form-control" value="{{$book->isbn ? $book->isbn : old('isbn')}}"  name="isbn" id="isbn">
  </div>

  <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="price" class="form-control" value="{{$book->price ? $book->price : old('price')}}"  name="price" id="price">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="{{route('books.index')}}" class="btn btn-secondary">Back</a>
</form>

@endsection