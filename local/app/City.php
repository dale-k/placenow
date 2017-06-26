<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	protected $table="cities";

	protected $fillable = array('city', 'post_count', 'follow_count','view_count');

}