@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Authors</div>

               <div class="card-body">
               <ul class="list-group">
                @foreach ($authors as $author)
                <li class="list-group-item list-line">
                <div>{{$author->name}} {{$author->surname}}</div> 
                <div class="list-line__buttons">
                <a href="{{route('author.edit',[$author])}}" class="btn btn-info">Edit</a>
                <form method="POST" action="{{route('author.destroy', [$author])}}">
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



