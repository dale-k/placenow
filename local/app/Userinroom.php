<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Userinroom extends Model
{


	public function countUser($id){
		$user_count = $this->where('chatroom_id',$id)->count();
		if(is_null($user_count)) $user_count=0;
		return $user_count;
	}


	// public function deleteUser($username,$chatroom_id){

	// 	$user_id = User::where('user',$username)->first()->id;

	// 	$theRecord = $this->where('user_id',$user_id)
	// 					  ->where('chatroom_id',$chatroom_id)
	// 					  ->delete();

	// }





}