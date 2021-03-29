@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Books</div>

               <div class="card-body">
                <ul class="list-group">
                @foreach ($books as $book)
                <li class="list-group-item list-line">
                <div>{{$book->title}} {{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</div> 
                <div class="list-line__buttons">
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



