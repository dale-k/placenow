<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Position extends Model
{
    public function user(){
         return $this->belongsTo(User::class);
    }
	
    public function storeAction($lat, $lng, $action, $city){
        $position = new Position;
        $position->lat = $lat;
        $position->lng = $lng;
        $position->action = $action;
        $position->city = $city;
        $position->user_id = Auth::user()->id;
        $position->save();

        return $position->id;
    }

    public function userLog($id){

        return $this->where('user_id',$id)->get();

    }

    // public function getOnlineUserNum(){
    //     // found user logged in 10 mins ago and have not logged out yet.
    //     $onlineUsers= $this->DB::table('positions as p1')
    //                     ->where('p1.action','login')
    //                     ->where('p1.created_at','<',DB::raw('NOW() - INTERVAL 10 MINUTES'))
    //                     ->join('positions as p2')
    //                     ->where('p1.user_id','p2.user_id')
    //                     ->whereNotExists('p2.action','logout')
    //                     ->where('p2.created_at','<',DB::raw('NOW() - INTERVAL 10 MINUTES'))
    //                     ->get();

    //     return $onlineUsers->count();
    // }
 

	 
}

