@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Create genre</div>

               <div class="card-body">
                <form method="POST" action="{{route('genre.store')}}">

                <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form control" name="genre_name" value="{{old('genre_name')}}">
                <small class="form-text text-muted">Please enter new genre's name</small>
                </div>
                @csrf
                <button type="submit" class="btn btn-primary">ADD</button>
                </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection