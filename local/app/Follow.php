<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public function user($user_id){
    	
    	$followed_list = Follow::where('user_id',$user_id)->get();
    	
    	return $followed_list;
    }

}
