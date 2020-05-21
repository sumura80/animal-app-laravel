@extends('layouts.app')

@section('content')


<h1 class="mt-4">記事一覧</h1>
<!-- only Author can post with auth() method -->
  @if(!Auth::guest())
    @if(Auth::user()->role === 'administrator')
      <a href="/posts/create" class="btn btn-success mb-4">Post</a>
    @endif
  @endif

  @if(count($posts) > 0)
      @foreach($posts as $post) 
      <h3><a href="/posts/{{$post->id}}">{{ $post->title }}</a></h3>    
      <p>Written on {{ $post->created_at->format('m/d/Y')  }}</p>
      {{-- <p>Category: {{$post->category['name'] }}</p> --}}
      @if(!empty($post->category))
        <p>Category: {{$post->category->name }}</p>
      @else
        <p>Category: Others</p>
      @endif
      <hr>
      {{-- <p>{{ $post->body }}</p> --}}
      <p>{{ strip_tags(Str::limit($post->body,200)) }}</p>
      <br>
      
      @endforeach
      {{$posts->links()}}
  @else
    <p>No posts</p>
  @endif







@endsection