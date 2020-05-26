<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Image;


class ImageController extends Controller
{
    public function upload(Request $request){
        // dd($request);
        $this->validate($request, [
            'post_image' => 'image|nullable|max:1999'
        ]);

        // if($request->hasFile('post_image')){
            
        // }

        $image = new Image;
        // $image->post_image = request('post_image');
        //$image->post_image = $request->input('post_image');
        // $uploaded_image = $request->file('post_image');
        
        // if($request->hasFile('post_image') && $uploaded_image-> isValid()){
        //     $file_name = $request->file('post_image')->getClientOriginalName();
        //     $path =$request->file('post_image')->storeAs($file_name);
        //     dd($path);
        //     $image->post_image = $path;
            
        //     $image->save();
        //     return redirect('/posts');
        // }
         
        //取得ファイル
        //  $uploaded_image=$request->file('post_image');

         
         //fileの名前
        //  $file_name =$request->file->getClientOriginalName();

        //画像ファイルが生成される&pathにフォルダのパスが記述される
        $path = $request->file->store('public/img');

        //読み込む先のpathを/storageに変更
        // $read_temp_path = str_replace('public/', 'storage/',);

        //$pathの値をDBに入れる
        Image::insert([
        "post_image" => $path
        ]);

        
        
        return [ 'location'=> asset(str_replace('public/','storage/', $path))];
        // return ['location'=>$path];
        // return ['location'=> 'http://127.0.0.1:8000/storage/img/3YRr0vgi2sp3zjtwYXAPpxMsHr8V5Hw82B8hcwxX.png'];
        
        }
   
  
}
