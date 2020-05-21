@extends('layouts.app')

@section('content')

  <div class="row mt-4">
    <div class="col-md-8">
      <h1>Categories</h1>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Edit</th>
            <th>Post Counts</th>
            {{-- <th>Delete</th> --}}
          </tr>
        </thead>

        <tbody>
          @foreach($categories as $category)
          <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td><a href="{{route('categories.edit',$category->id)}}"><span><i class="fas fa-edit"></i></span></a></td>
           {{-- <td><a href="{{route('categories.destroy',$category->id)}}"><span><i class="far fa-trash-alt"></i></span></a></td> --}}
            {{-- <td>
              <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-outline-danger" value="Delete" >  
              </form>
            </td> --}}
            <td>{{$category->posts()->count()}}</td>
          </tr>
          
          @endforeach
        </tbody>
      </table>
    </div><!-- end of .col-md-8 -->

    <div class="col-md-4">
      <div class="card">
        <h5 class="card-header">New Category</h5>
        <div class="card-body">
          
          <form action="{{route('categories.store')}}" method="POST">
            @csrf
            <label >Category name</label>
            <input name="name" type="text" class="form-control @error('name') border border-danger @enderror" placeholder="Enter category name">
              @if($errors-> has('name') )
                <div class="alert alert-danger mt-2">
                  {{$errors->first('name')}}
                </div>
               @endif 

            <input type="submit" class="btn btn-success btn-block mt-3" value="Add Category">
          </form>
        </div><!-- end of card-body -->
      </div>
    </div>
    
    
    
    
    
    
    
    
  </div><!-- end of row -->


@endsection