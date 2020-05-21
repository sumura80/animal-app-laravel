@extends('layouts.app')


@section('content')

<h1>Query検索結果一覧</h1>

<p>あなたが入力したキーワード:{{implode(',', $keyword)}}</p>

@forelse($search_results as $result) 
  <div class="alert alert-secondary mb-4">
    Title: <a href="/posts/{{$result->id}}">{{$result->title}}</a><br>
    {{-- Content:{{$result->body}}<br> --}}
    Content:{{ strip_tags(Str::limit($result->body,200))}}
  </div>
  @empty 
    <p>No results</p>
  @endforelse

  <!-- Paginate -->
<div class="row">
    <div class="col-12 text-center">
      {{ $search_results->appends(['keyword' => implode(' ', $keyword)])->links() }}
       {{-- {{ $search_results->links() }}  --}}
      <!-- この書き方では、変な動作が起きた。Officialでの　内容を参考にする　https://laravel.com/docs/7.x/pagination#introduction-->
    </div>
  </div> 

  @endsection
