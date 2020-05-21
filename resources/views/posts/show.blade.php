 
@extends('layouts.app')

@section('content')

<h1 class="mt-4">{{ $post->title}}</h1>
<div class="text-muted">Writte on: {{ $post->created_at->format('m/d/Y') }} 
  @if(!empty($post->modified_at))
    <span class="text-muted ml-2">
     Last Updated on: {{ $post->modified_at->format('m/d/Y') }}
    </span>
  @endif
 </div>

  {{-- <p>Category In: {{$post->category->name}}</p> --}}
  @if(!empty($post->category))
  <p>Category: {{$post->category->name }}</p>
  @else
  <p>Category: Others</p>
  @endif
  {{-- <p>{{ $post->body }}</p> --}} 
 


<div class="row"><!-- Both box row -->
  
  <!-- Start Left side box in case of bigger than medium size -->
  <div class="col-md-3 d-none d-md-block">
    <div class="list-group">
    <a href="#" class="list-group-item list-group-item-action font-weight-bold rounded-0 disabled" style="background-color: #DBF5DA;">{{$post->category->name}}</a>
    </div>
    @foreach($same_category_posts as $each_post)
      <div class="list-group">
      {{-- <a href="{{$each_post->id}}" class="list-group-item list-group-item-action rounded-0 {{$post->id ==$each_post->id ? 'disabled': ''}}"　style="{{$post->id ==$each_post->id ? 'background-color:#F3FCFD;' : ''}}">{{$each_post->title}}</a> --}}
      <a href="{{$each_post->id}}" class="list-group-item list-group-item-action rounded-0 {{$post->id ==$each_post->id ? 'disabled bg-light border-info': ''}}">{{$each_post->title}}</a>
      </div> 
    @endforeach
  </div><!-- End Left side box -->

  <!-- Start Left side box in case of smaller than SMALL size -->
  <div class="col-md-3 d-block d-md-none mb-4">
    

    <div class="card">
      <div class="card-header" role="tab" id="collapseListGroupHeading1">
        <h5 class="mb-0">
          <a href="#collapseListGroup1" class="collapsed text-body d-block p-3 m-n3" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseListGroup1"> Other posts </a>
        </h5>
      </div><!-- /.card-header -->
      <div class="collapse" role="tabpanel" id="collapseListGroup1" aria-labelledby="collapseListGroupHeading1" aria-expanded="false">
        <ul class="list-group list-group-flush">
          @foreach($same_category_posts as $each_post)
          <div class="list-group">
            <li href="{{$each_post->id}}" class="list-group-item list-group-item-action" style="border-radius: 0px;">{{$each_post->title}}</li>
          </div> 
          @endforeach

        </ul>
      </div><!-- /.collapse -->
    </div><!-- /.card -->







  </div><!-- End Left side box -->


  <!-- Start Right side box -->
  <div class="col-md-9">


      <p>{!! nl2br($post->body) !!}</p>
      <br>
  </div><!-- End Right side box -->
</div><!-- End Both box row -->



<br>

<div class="buttons d-flex justify-content-start">
  <a href="/" class="btn btn-secondary mr-2 mx-auto d-block">Go Back</a>

  <!-- Auth == post user_id can EDIT and DELETE -->
  @if(!Auth::guest()) <!-- If the author were not guest -->
      {{-- @if(Auth::user()->id == $post->user_id ) --}}
      @if(Auth::user()->role === 'administrator')
        <a href="/posts/{{$post->id}}/edit" class="btn btn-warning mr-2">Edit</a>

        <form action="/posts/{{$post->id}}" method="POST">
          @csrf
          @method('DELETE')
          <input type="submit" value="Delete" class="btn btn-danger">
        </form>
      @endif
  @endif
</div>
<br><br>


  
@endsection
