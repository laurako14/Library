@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
               <h2>Books</h2>
                <div class="make-inline">
                <form action="{{route('book.index')}}" method="get" class="make-inline">
                <div class="form-group make-inline">
                {{-- <select name="author_id" class="form-control">
                <option value="0" disabled @if($filterBy == 0) selected @endif>Select author</option>
                    @foreach ($authors as $author)
                        <option value="{{$author->id}}" @if($filterBy == $author->id) selected @endif>{{$author->name}} {{$author->surname}}</option>
                    @endforeach
                </select> --}}
                </div>
                {{-- <label class="form-check-label">Sort by title</label>
                <div class="form-group make-inline column">
                    <input type="radio" class="form-check-input" name="sort" value="asc" id="sortASC" @if($sortBy == 'asc') checked @endif>
                </div>
                <div>
                    <label class="form-check-label" id="sortASC">ASC</label>
                </div>
                <div class="form-group make-inline column">
                    <input type="radio" class="form-check-input" name="sort" value="desc" id="sortDESC" @if($sortBy == 'desc') checked @endif>
                </div>
                <div>
                    <label class="form-check-label" id="sortDESC">DESC</label>
                </div>
               <button type="submit" class="btn btn-primary nice">Filter</button>    --}}
               </form>
               <a href="{{route('book.index')}}" class="btn btn-primary">Back</a>
               </div>
               </div>

               <div class="card-body">
                <ul class="list-group">
                @foreach ($books as $book)
                <li class="list-group-item list-line">
                <div class="list-line__books">
                    <div class="list-line__books__title">{{$book->title}}</div> 
                    <div> by</div> 
                    <div class="list-line__books__author">{{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</div>
                    <div> published by</div>
                    <div class="list-line__books__author">{{$book->bookPublisher->name}}</div>
                    </div>
                <div class="list-line__buttons">
                <a href="{{route('book.show',[$book])}}" class="btn btn-info">Show</a>
                <a href="{{route('book.edit',[$book])}}" class="btn btn-info">Edit</a>
                <form method="POST" action="{{route('book.destroy', [$book])}}">
                @csrf
                <button type="submit" class="btn btn-warning">DELETE</button>
                </form>
                </div>
                </li>
                @endforeach
                </ul>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection