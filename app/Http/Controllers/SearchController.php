<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SearchController extends Controller
{
  public function index(Request $request){

   
    // FORMの name="keyword" の値を取得
    // $keyword = $request->input('keyword');
    $keyword = mb_convert_kana($request->input('keyword'),'s');
    $keyword = explode(' ',$keyword);
    // dd($keyword);
    
    
     
    
    //#クエリ生成
    //$query = new Post;とも書ける。
    $query = Post::query();

    //文字を入れないと検索できないようにしているvalidation
    $request->validate([
      'keyword' => 'required|min:1'
    ]);
    


    //#もしキーワードがあったら　１単語検索の時
    // if(!empty($keyword))
    // {
    //    $query = $query->where('title','like','%'.$keyword.'%')->orWhere('body','like','%'.$keyword.'%');
      
    // }
    //#もしキーワードがあったら
    //複数単語検索の時の書き方
    	//#もしキーワードがあったら
      if(!empty($keyword))
      {
      foreach ($keyword as $word) {
          $query = $query->orWhere(function($where_query) use ($word) {
              // カッコ内に入れるWhereを作る処理
              $where_query->where('title','like','%'.$word.'%');
              $where_query->orWhere('body','like','%'.$word.'%');
          });
      }
      }
    
    
    // dd($query->toSql(), $query->getBindings());
    // dd($query->toSql());
    // \DB::enableQueryLog();
    $search_results= $query->orderBy('created_at', 'desc')->paginate(3);
    
    // $search_results= $query->orderBy('created_at', 'desc')->get();
    // dd(\DB::getQueryLog());
    //  dd($search_results->toSql());
    //  dd($search_results);
    //  dd($search_results->count());
     
    return view('partial.searchresult')->with('search_results',$search_results)->with('keyword',$keyword);
       
  }

}
