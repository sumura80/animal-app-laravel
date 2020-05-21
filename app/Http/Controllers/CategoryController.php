<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
class CategoryController extends Controller
{

    public function __construct(){
        // $this->middleware('auth');
        //ゲストでもindexは見れるようになっている（adminだけが見れるように修正必要）5/9/2020
        $this->middleware('auth',['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $categories = Category::all();
       if(Auth::user()->role !== 'administrator'){
        return redirect('/posts')->with('error', 'Unauthorized action');
       }
     return view('categories.index')->with('categories',$categories);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Save a new category and redirect back to index of category
        //ここはarrayでvalidate
        $this->validate($request,array(
            'name'=>'required'
        ));
        
        $category = new Category;
        $category->name = request('name');
        $category->save();
        return redirect('categories')->with('success','New Category has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        if(Auth::user()->role !== 'administrator'){
            return redirect('/posts')->with('error', 'Unauthorized action');
           }
        return view('categories.edit')->with('category',$category);;
        
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
        //
        
        $this->validate($request,array(
            'name'=>'required'
        ));
        $category = Category::findOrFail($id);
        // $post = Post::findOrFail($id);
        // $post->title = request('title');
        // $post->body = request('body');
        // $post->update();
        $category->name = request('name');
        if(Auth::user()->role !== 'administrator'){
            return redirect('/posts')->with('error', 'Unauthorized action');
           }
        $category->update();

        return redirect('/categories')->with('success','Category Modified');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete category
        $category = Category::findOrFail($id);
        if(Auth::user()->role !== 'administrator'){
            return redirect('/posts')->with('error', 'Unauthorized action');
           }
        $category->delete();
        return redirect('/categories')->with('success','Category Deleted');
    }
}
