<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use App\Category;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Arr; 

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index', 'show']]);

        //This is new way $this->middleware('auth')->except(['index', 'show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(5);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Category::all();
        if(auth()->user()->role !== 'administrator'){
            return redirect('/posts')->with('error', 'Unauthorized action');
        }
        return view('posts.create',['cat'=>$cat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = request()->validate([
        //     'title'=>'required',
        //     'body'=>'required',
        //     'category_id'=>'required'
        // ]);

        $this->validate($request,[
                'title'=>'required',
                'body'=>'required',
                'category_id'=>'required'
            ]);
            
            
        //Post::create($validatedData);
          
       $post = new Post;
       $post->title = request('title');
       //$post->slug = str_slug($request->title);
       $post->slug = Str::slug($request->title,'-');
       $post->body = request('body');
       $post->category_id = request('category_id');
       $post->user_id = Auth::id();
       $post->save();

       return redirect('/posts')->with('success','Post Created');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(\App\Post $post,$id)
    // {   
    //     $post = Post::findOrFail($id);
    //     $post_cat_id = $post->category_id;
    //     // dd($post_cat_id);
    //     $same_category_posts = Post::where('category_id',$post_cat_id)->orderBy('id','asc')->get();
    //     // $count_cat= $same_category_posts->count();
    //     // dd($count_cat);
        
    //     return view('posts.show ')->with('post', $post)->with('same_category_posts',$same_category_posts);
    // }
   
    // This is better way to code
    public function show(Post $post)
    {   
    // find($id)で取得した結果が$postに入っている。
    // dd($post->toArray());
    $post_cat_id = $post->category_id;
    $same_category_posts = Post::where('category_id',$post_cat_id)->orderBy('id','asc')->get();
     return view('posts.show ')->with('post', $post)->with('same_category_posts',$same_category_posts);
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $cat = Category::all();
        //Check for correct user . only user can edit
        //作ったUserだけがEditできる
        // if(auth()->user()->id !== $post->user_id){
        // return redirect('/posts')->with('error', 'Unauthorized action');
        // }

        if(auth()->user()->role !== 'administrator'){
                 return redirect('/posts')->with('error', 'Unauthorized action');
             }       
        return view('posts.edit',['cat'=>$cat])->with('post', $post);


        /*  This is new way to code to limit access
            @auth <!-- your blade codes --> @endauth (check authenticated )
            @guest <!-- your blade codes --> @endguest (check not authenticated )
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $validatedData = request()->validate([
            'title'=>'required',
            'body'=>'required',
            'category_id'=>'required'
        ]);
        $post = Post::findOrFail($id);
        $post->category_id = request('category_id');
        $post->title = request('title');
        $post->body = request('body');
        $post->modified_at = Carbon::now();
        $post->update();

      

        // $post->update($validatedData);

        return redirect('/posts/' .$post->id)->with('success','Post Updated');

       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        //Check for correct user . only user can edit
        // if(auth()->user()->id !== $post->user_id){
        if(Auth::user()->role !== 'administrator'){
         return redirect('/posts')->with('error', 'Unauthorized action');
        }
        $post->delete();
        return redirect('/posts')->with('success','Post Removed');

    }
}
