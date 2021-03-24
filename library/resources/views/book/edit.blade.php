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
                <small class="form-text text-muted">Knygos pavadinimas.</small>
                </div>
                ISBN: <input type="text" name="book_isbn" value="{{$book->isbn}}">
                Pages: <input type="text" name="book_pages" value="{{$book->pages}}">
                About: <textarea name="book_about">{{$book->about}}"</textarea>
                <select name="author_id">
                    @foreach ($authors as $author)
                        <option value="{{$author->id}}" @if($author->id == $book->author_id) selected @endif>
                            {{$author->name}} {{$author->surname}}
                        </option>
                    @endforeach
            </select>
                @csrf
                <button type="submit">EDIT</button>
            </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection


