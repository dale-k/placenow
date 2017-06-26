<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Place;
use City;
class Chatroom extends Model
{

	protected $fillable =  ['related_id', 'type', 'name'];

	public function createNewroom($name,$id,$type){
		
		$newRoom = New Chatroom;
		$newRoom->name = $name;
		$newRoom->related_id = $id;
		$newRoom->type = $type;
		$newRoom->save();

		return $newRoom;

	}
	public function findRoomByLocation($gplace_id,$name){
		$location_room = $this->firstOrNew(array('type'=>'location','related_id'=>$gplace_id,'name'=>$name));
		$location_room->save();

		return $location_room;

	}

	public function findRoomByCity($city){
		
		$city_room = $this->firstOrNew(array('type'=>'city','name'=>$city,'related_id'=>$city));
		$city_room->save();

		return $city_room;
	}
	

}
