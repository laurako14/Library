@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Add book</div>

               <div class="card-body">
                <form method="POST" action="{{route('book.store')}}">
                <div class="form-group">
                <label>Title:</label>
                <input type="text" class="form control" name="book_title">
                <small class="form-text text-muted">Please enter new book title</small>
                </div>
                <div class="form-group">
                <label>ISBN:</label>
                <input type="text" class="form control" name="book_isbn">
                <small class="form-text text-muted">Please enter new book ISBN</small>
                </div>
                <div class="form-group">
                <label>Pages:</label>
                <input type="text" class="form control" name="book_pages">
                <small class="form-text text-muted">Please enter page count</small>
                </div>
                <div class="form-group">
                <label>About:</label>
                <textarea name="book_about" id="summernote"></textarea>
                <small class="form-text text-muted">Please enter description</small>
                </div>
                <div class="form-group">
                <label>Author:</label>
                <select name="author_id">
                    @foreach ($authors as $author)
                        <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                <label>Publisher:</label>
                <select name="publisher_id">
                    @foreach ($publishers as $publisher)
                        <option value="{{$publisher->id}}">{{$publisher->name}}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                <label>Genre:</label>
                <select name="genre_id">
                    @foreach ($genres as $genre)
                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                    @endforeach
                </select>
                </div>
                @csrf
                <button type="submit" class="btn btn-primary">ADD</button>
                </form>
               </div>
           </div>
       </div>
   </div>
</div>
<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>

@endsection


