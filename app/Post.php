<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Post extends Model
{
    protected $fillable=[
        'title','body','category_id','modified_at'
    ];


    public function user(){
        return $this->belongTo(User::class);
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    protected $dates = [
        'modified_at'
    ];
}
