@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
               <h2>Genres</h2>
               
               <a href="{{route('genre.index', ['sort' => 'name'])}}" class="btn btn-primary">Sort by name</a>
               <a href="{{route('genre.index')}}" class="btn btn-primary">Default</a>
               </div>

               <div class="card-body">
               <ul class="list-group">
                @foreach ($genres as $genre)
                <li class="list-group-item list-line">
                <div>{{$genre->name}}</div> 
                <div class="list-line__buttons">
                <a href="{{route('genre.edit',[$genre])}}" class="btn btn-info">Edit</a>
                <form method="POST" action="{{route('genre.destroy', [$genre])}}">
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