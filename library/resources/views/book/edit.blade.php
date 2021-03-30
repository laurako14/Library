@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit book</div>

               <div class="card-body">
                <form method="POST" action="{{route('book.update',[$book])}}">
                <div class="form-group">
                <label>Title</label>
                <input type="text" name="book_title"  class="form-control" value="{{$book->title}}">
                <small class="form-text text-muted">Please enter title</small>
                </div>
                <div class="form-group">
                <label>ISBN:</label>
                <input type="text" class="form control" name="book_isbn" value="{{$book->isbn}}">
                <small class="form-text text-muted">Please enter book ISBN</small>
                </div>
                <div class="form-group">
                <label>Pages:</label>
                <input type="text" class="form control" name="book_pages" value="{{$book->pages}}">
                <small class="form-text text-muted">Please enter page count</small>
                </div>
                <div class="form-group">
                <label>About:</label>
                <textarea name="book_about" id="summernote">{{$book->about}}</textarea>
                <small class="form-text text-muted">Please enter description</small>
                </div>
                <div class="form-group">
                <label>Author:</label>
                <select name="author_id">
                    @foreach ($authors as $author)
                        <option value="{{$author->id}}" @if($author->id == $book->author_id) selected @endif>{{$author->name}} {{$author->surname}}</option>
                    @endforeach
                </select>
                </div>
                @csrf
                <button type="submit" class="btn btn-primary">EDIT</button>
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


