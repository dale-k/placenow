<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use App\Message;
use App\Chatroom;
use App\Userinroom;
use App\Position;
use App\Place;
use App\City;
use App\CityFollow;
use App\PlaceFollow;

class msgController extends Controller
{
    
    public function loadPublicMessage(){

    	$messages = Message::where('chatroom_id',1)->take(100)->get();

        $user_position = Position::where('user_id',Auth::user()->id)
                                ->where('action','chat')
                                ->orderBy('created_at','desc')
                                ->first();
        $position = $user_position;
        
        $page_loc = array('type'=>'public');




    	return view('chat.chat',compact('messages','position','page_loc'));

    }
    public function loadNearByMessage(){

        $messages = Message::where('chatroom_id',1)->take(100)->get();

        $user_position = Position::where('user_id',Auth::user()->id)
                                ->where('action','chat')
                                ->orderBy('created_at','desc')
                                ->first();
        $position = $user_position;
        $page_loc = array('type'=>'nearby');




        return view('chat.chat_nearby',compact('messages','position','page_loc'));
    }


    public function loadCityMessage($city){
        $chatroom_id =new Chatroom;
        $chatroom_id =$chatroom_id->findRoomByCity($city)->id;

        $messages = Message::where('chatroom_id',$chatroom_id)->take(100)->get();


        $user_position = Position::where('user_id',Auth::user()->id)
                                ->where('action','chat')
                                ->orderBy('created_at','desc')
                                ->first();
        $position = $user_position;
        
        $page_loc = array('type'=>'city');

        $this_city = City::firstOrCreate(['city'=> $city]);

        $city_follow = CityFollow::where('user_id',Auth::user()->id)->where('city_id',$this_city->id)->first();


        return view('chat.chat_city',compact('messages','position','page_loc','this_city','city_follow'));
    }
    // loading locaiton list
    public function loadLocationMessage(){

        $user_position = Position::where('user_id',Auth::user()->id)
                                ->where('action','chat')
                                ->orderBy('created_at','DESC')
                                ->first();
        $position = $user_position;

        $page_loc = array('type'=>'location-loading');

        return view('chat.chat_locationload',compact('position','page_loc'));
    }

    // get chatroom
    public function findRoom(Request $request){
        $place_name = $request->place_name;
        $gplace_id = $request->gplace_id;

        $new_chatroom = Chatroom::where('related_id',$gplace_id)->first();
        if(is_null($new_chatroom)){
            $new_chatroom = new Chatroom;
            $new_chatroom->type = "location";
            $new_chatroom->name = $place_name;
            $new_chatroom->related_id = $gplace_id;
            $new_chatroom->save();
        }
        
        return $new_chatroom;
    }

    // show all msg in the place
    
    public function loadPlaceMessage($place){
         $chatroom_id = new Chatroom;
         $chatroom_id = $chatroom_id->where('related_id',$place)->first()->id;

         $messages = Message::where('chatroom_id',$chatroom_id)->take(100)->get();

         $user_position = Position::where('user_id',Auth::user()->id)
                                ->where('action','chat')
                                ->orderBy('created_at','desc')
                                ->first();
        $position = $user_position;

        $place_selected = Chatroom::where('related_id',$place)->first();

        $page_loc = array('type'=>'location');


        $this_place = Place::where('gplace_id',$place)->first();
        if(is_null($this_place)) $place_follow=null;
        else $place_follow = PlaceFollow::where('user_id',Auth::user()->id)->where('place_id',$this_place->id)->first();

        return view('chat.chat_place',compact('messages','position','page_loc','place_selected','this_place','place_follow'));

    }

    public function ajaxLoadMessage(Request $request){
             $type = $request->type;
             $place_id =$request->place_id;
             $name = $request->name;

        if($type=="public"){
            // load public chat room
            $chatroom_id = Chatroom::where('type','public')->first();
            $chatroom_id = $chatroom_id->id;
            $messages = Message::where('chatroom_id',$chatroom_id)->get();
        
        }else if($type=="location"){

            $chatroom_id = Chatroom::where('type',$type)->where('related_id',$place_id)->first();

            if(is_null($chatroom_id)){
                $chatroom_new = New Chatroom;
                $chatroom_new->type ="location";
                $chatroom_new->name = $name;
                $chatroom_new->related_id = $place_id;
                $chatroom_new->save();
                $chatroom_id = $chatroom_new->id;
            }else{
                $chatroom_id = $chatroom_id->id;   
            }

            $messages = Message::where('chatroom_id',$chatroom_id)->get();
           
        }else{
            // load city chat room

            $chatroom_id = Chatroom::where('type',$type)->where('related_id',$place_id)->first();

            if(is_null($chatroom_id)){
                $chatroom_new = New Chatroom;
                $chatroom_new->type ="city";
                $chatroom_new->name = $request->name;
                $chatroom_new->save();
                $chatroom_id = $chatroom_new->id;
            }else{
                $chatroom_id = $chatroom_id->id;   
            }

            $messages = Message::where('chatroom_id',$chatroom_id)->get();
        }

         

        foreach($messages as $message){
            $message->user;
        }

        $messages->put('data_length',$messages->count());
            
        $messages->put('user_count',0);

            return $messages;
    }

    public function storeMessage(Request $request){
        $message = $request->message;
        $related_id = $request->related_id;
        $type = $request->type;

        

        $storeMessage = new Message;
        $chatroom_id = Chatroom::firstOrCreate(['related_id'=>$related_id]);
        $chatroom_id = $chatroom_id->id;

        $storeMessage->message = $message;
        $storeMessage->chatroom_id = $chatroom_id;
        $storeMessage->user_id = Auth::user()->id;
        $storeMessage->save();

        
        $messages = Message::where('chatroom_id',$chatroom_id)->get();

        foreach($messages as $message){
            $message->user;
        }

        $messages->put('data_length',$messages->count());
            
        $messages->put('user_count',0);

    	return $messages;
    }

    
    

}

