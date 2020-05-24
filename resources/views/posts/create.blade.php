@extends('layouts.app')


  @section('content')

  <h1 class="mt-4">Create Post</h1>

  <form action="/posts"  method="POST">
    @csrf

    <div class="form-group">
      <label>Category</label>
      <select name="category_id" class="form-control">
        @foreach($cat as $key => $value)
          <option value="{{$value->id}}" class="form-control">{{$value->name}}</option>
        @endforeach
        
      </select>
         
    </div>
    
    <div class="form-group">
      <label>Title</label>
    <input type="text" class="form-control @error('title') border border-danger @enderror" name="title" value="{{ old('title')}}">
      @if($errors-> has('title') )
        <div class="alert alert-danger mt-2">
          {{$errors->first('title')}}
        </div>
      @endif 
      
    </div><br>
    <div class="form-group">
      <label>Content</label>
        <textarea id="tiny" name="body" cols="5" rows="8" class="form-control @error('body') border border-danger @enderror"  >{{old('body')}}</textarea>
      @if($errors-> has('body') )
      <div class="alert alert-danger mt-2">
        {{$errors->first('body')}}
      </div>
    @endif 
      
    </div>




    

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

 
  @endsection
