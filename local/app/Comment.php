<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	public function picture(){
		return $this->belongsTo(Picture::class);
	}

	public function user(){
		return $this->belongsTo(User::class);
	}

}