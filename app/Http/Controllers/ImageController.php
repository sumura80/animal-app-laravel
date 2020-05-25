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
        $uploaded_image = $request->file('post_image');
        if($request->hasFile('post_image') && $uploaded_image-> isValid()){
            $file_name = $request->file('post_image')->getClientOriginalName();
            $path =$request->file('post_image')->storeAs($file_name);
        }
        $image->post_image = $path;
        $image->save();
        return redirect('/posts');
       
        
       
    }
}
