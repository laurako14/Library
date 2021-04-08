@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Create publisher</div>

               <div class="card-body">
                <form method="POST" action="{{route('publisher.store')}}">

                <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form control" name="publisher_name" value="{{old('publisher_name')}}">
                <small class="form-text text-muted">Please enter new publisher's name</small>
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