
@extends('layouts.app')

@section('content')
<h1>Category Edit</h1>
<div class="row mt-4">
  <div class="col-md-6 mx-auto">
      <div class="card">
        <h5 class="card-header text-danger">Edit Category</h5>
        <div class="card-body">
          
          <form action="{{route('categories.update', $category->id)}}" method="POST">
            @csrf
            @method('PUT')
            <label >Category name</label>
             <input name="name" type="text" class="form-control" value="{{$category->name}}">

            <input type="submit" class="btn btn-info btn-block mt-3" value="Save Category">
          </form>
        </div><!-- end of card-body -->
      </div>
    </div>
    
  </div><!-- end of row -->


@endsection