<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\CityFollow;
use App\User;
use App\Follow;
use Auth;


class userController extends Controller{

    public function follow($username){

    	$follow_id = User::where('user',$username)->first()->id;
    	$follow = New Follow;
    	$follow->user_id = Auth::user()->id;
    	$follow->follow_id = $follow_id;
    	$follow->save();

    	return redirect('/ppl/'.$username);

    }

    public function unfollow($username){
    	$follow_id = User::where('user',$username)->first()->id;

    	Follow::where('user_id',Auth::user()->id)
    		  ->where('follow_id',$follow_id)
    		  ->first()
    		  ->delete();

    	return redirect('/'.$username);	  
    }

    public function followcity($city){

        $user_id = Auth::user()->id;

        $db_city = City::firstOrCreate(['city'=>$city]);
        $city_id = $db_city->id;

        if ( !CityFollow::where('user_id',$user_id)->where('city_id',$city_id)->first() ){
            $followCity = New CityFollow;
            $followCity->user_id = $user_id;
            $followCity->city_id = $city_id;
            $followCity->save();

            $db_city->follow_count += 1;
            $db_city->save();
        }

        return redirect('/city/'.$city);

    }

    public function unfollowcity($city){
        $db_city = City::where('city',$city)->first();
        $city_id = $db_city->id;

        CityFollow::where('user_id',Auth::user()->id)
                  ->where('city_id',$city_id)
                  ->first()
                  ->delete();

        $db_city->follow_count -= 1;
        $db_city->save();

        return redirect('/city/'.$city);   
    }
}
