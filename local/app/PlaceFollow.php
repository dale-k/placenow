<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceFollow extends Model
{
	protected $table='place_follows';

	public function place(){
		return $this->hasMany(Place::class);
	}
}