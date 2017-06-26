<?php

namespace App\Http\Controllers;


use App\Position;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class positionController extends Controller{

	public function storePosition(Request $request){

		$lat = $request->lat;
		$lng = $request->lng;
		$action = $request->action;
		$city = $request->city;
		$user_id = Auth::user()->id;
		$check_log = Position::where('user_id',$user_id)
							   ->where('action','chat')
							   ->where(DB::raw('TIMESTAMPDIFF(minute,created_at,now()-TIMEDIFF(now(), UTC_TIMESTAMP))>5'))
							   ->orderby('created_at','desc')
							   ->first();
		// update the chat postion created longer than 5 minute ago
		if(!is_null($check_log)){
		$user_pose = new Position;
		$user_pose->lat = $lat;
		$user_pose->lng = $lng;
		$user_pose->action = $action;
		$user_pose->city = $city;
		$user_pose->user_id = $user_id;

		$user_pose->save();
		}

	}


}