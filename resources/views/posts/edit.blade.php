@extends('layouts.app')


  @section('content')

  <h1 class="mt-4">Edit table</h1>

  <form action="/posts/{{$post->id}}" method="POST" enctype='multipart/form-data'>
    @csrf
    @method('PUT')
    <div class="form-group">
      <label>Category</label>
      <select name="category_id" class="form-control">
        <?php $selectedvalue = $post->category_id ?>
        @foreach($cat as $key => $value)
      <option value="{{$value->id}}" {{$selectedvalue == $value->id ? 'selected="selected"' : '' }} class="form-control">{{$value->name}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>Title</label>
      <input type="text" class="form-control" name="title" value="{{$post->title}}">
      
    </div><br>
    <div class="form-group">
      <label>Content</label>
      <textarea id="tiny" name="body"cols="5" rows="8" class="form-control" >{{$post->body}}</textarea>
      
    </div>

    <button type="submit" class="btn btn-primary">Save edit</button>
  </form>

 
  @endsection
