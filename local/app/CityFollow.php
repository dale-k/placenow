<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityFollow extends Model
{
	protected $table='city_follows';

	public function city(){
		return $this->hasMany(City::class);
	}

	
}