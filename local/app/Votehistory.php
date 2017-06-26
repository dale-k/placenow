<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Votehistory extends Model
{
    public function pictures(){
    	return $this->hasMany(Post::class);
    }

    public function users(){
    	return $this->hasMany(User::class);
    }

    public function loadVotehistory($user_id,$picture_id){
    	$result = $this->where('user_id',$user_id)
    				   ->where('picture_id',$picture_id)
    				   ->select('voted','favored','recommended')
    				   ->first();
        if(count($result)==0){
            $result = new Votehistory;
            $result->user_id = $user_id;
            $result->picture_id = $picture_id;
            $result->save();
        }
    	return $result;

    }

    public function loadVotehistoryList($ids){
        $list = array();
        for($i=0;$i<count($ids);$i++){
        $row=$this->loadVotehistory(Auth::user()->id,$ids[$i]);
        array_push($list,$row);
        }
        return $list;
    }
}
