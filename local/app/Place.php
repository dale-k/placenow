<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
	
    public function picture(){
    	return $this->hasMany(Post::class);
    }

    public function picturebydate($num){
        return $this->hasMany(Post::class)->orderBy('created_at','desc')->take($num)->get();
    }

    public function picturebypopluar($num){
        return $this->hasMany(Post::class)
        ->select(DB::raw('posts.* , (posts.vote_count+posts.favor_count+posts.recommend_count+posts.view_count) as count '))
        ->orderBy('count','desc')->take($num)->get();
    }


    public function picture_ByCity($place){
    	$result = [];
    	$result = $this
                    ->join('posts','places.id','=','posts.place_id')
                    ->select('posts.*','places.*')
                    ->where('places.city','=',$place)
                    ->get();
        if (count($result)){
    		return $result;
    	}else{
    		return $result;
    	}
    }
 

	 
}

