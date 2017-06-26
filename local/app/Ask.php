<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Ask extends Model
{

	protected $table="ask";

	//protected $fillable =  ['related_id', 'type', 'name'];


	public function user(){
    	return $this->belongsTo(User::class);
    }

	public function storeNewQuestion($list){
		
		$store = New Ask;
		$store->user_id = Auth::user()->id;
		$store->city = $list->city;
		$store->place = $list->place;
		$store->question = $list->question;
		$store->save();

	}

	public function popularQuestion(){
		$db_ask = Ask::orderBy('created_at','desc')
		             ->orderBy('num_answer','desc')
		             ->take(8)
		             ->get();

		return $db_ask;
	}

	public function popularQuestioninCity($city){
		$db_ask = Ask::where('city',$city)
					 ->orderBy('created_at','desc')
		             ->orderBy('num_answer','desc')
		             ->take(1)
		             ->get();

		return $db_ask;
	}
	

}
