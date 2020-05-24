<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/about',function(){
//     return view('pages.about');
// });

Route::get('/', 'PostsController@index');
Route::get('about', 'PagesController@about');
Route::get('service', 'PagesController@service');
 
// Route::get('posts/{post}', function (App\Post $post) {
//   dd($post->toArray());
// });

Route::resource('posts','PostsController');

Route::resource('posts','PostsController',['except' => ['show']]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Catetories
Route::resource('categories','CategoryController',['except'=>['create']]);

//Search result
Route::get('/search','SearchController@index');


//Image post with TinyMCE
Route::post('/image/upload','ImageController@upload');
