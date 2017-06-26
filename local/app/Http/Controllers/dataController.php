<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Input;
use App\Ask;
use App\Post;
use App\Place;
use App\Votehistory;
use App\Tag;
use App\City;
use App\Chatroom;
use App\Message;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dataController extends Controller{
	

	public function savePost(Request $request){
		
		$picture = New Post;
		
		$tags = New Tag;

		$city = trim($request->city);

		if ( $request->selectTextOnly == 'photo' ){

			if ( $request->file('picloc') == null ){
				return;
			}else {
				$img = $request->file('picloc');
			}

			list($originalWidth, $originalHeight) = getimagesize($img);
			$deg = $request->imgDeg;
			$extension = $img->getClientOriginalExtension();

			$pic_loc = $this->uploadPhoto($img, $deg, $extension, $city, $originalWidth, $originalHeight);

			$picture->pic_location = $pic_loc;

		}

		

		$place= $this->createPlace($request);

		$picture->user_id = Auth::user()->id;
		$picture->place_id = $place->id;
		$picture->title = $request->title;
		$picture->comment = $request->comment;
		$picture->lat = $request->picture_lat;
		$picture->lng = $request->picture_lng;
		$picture->photo = $request->selectTextOnly;
		$picture->private = $request->privateOrPublic;
		$picture->save();
		
		if ( count($request->tags) > 0 ){
			$tags->storeNewTag($picture->id,$request->tags);
		}

		$history = New Votehistory;
		$history->picture_id = $picture->id;
		$history->user_id = Auth::user()->id;
		$history->voted=false;
		$history->favored=false;
		$history->recommended=false;
		$history->save();

		// increment post_count in city table and place table
		//App\Flight::firstOrCreate(['name' => 'Flight 10']);

		$db_city = City::firstOrCreate(['city'=>$city]);
		$db_city->increment('post_count');
		$db_city->save();

//		$pictures = Picture::all();

		return redirect('/');

	}
	private function uploadPhoto($img, $deg, $extension, $city, $originalWidth, $originalHeight){
		$newPath = 'img/';
		$created = date("Y-m-d--h-i-sa");
		$newFilename = $city.$created.'.jpg';
		
		if($extension=='jpg'){
			$source = imagecreatefromjpeg($img);
		}else if ($extension=='png'){
			$source = imagecreatefrompng($img);
		}else if($extension=='gif'){
			$source = imagecreatefromgif($img);
		}else if($extension=='bmp'){
			$source = imagecreatefrombmp($img);
		}else{

		}

		$exif = exif_read_data($img);

	    if (empty($exif['Orientation']))
	    {
	      
	    }else{

	    switch ($exif['Orientation'])
	    {
	        case 3:
	            $source = imagerotate($source, 180, 0);
	            break;
	        case 6:
	            $source = imagerotate($source, - 90, 0);
	            break;
	        case 8:
	            $source = imagerotate($source, 90, 0);
	            break;
	    }

		}


		//$img =  imagerotate($source,$deg,0);
		
		
		$ratio = $originalWidth / $originalHeight;

		// if($ratio>=1){
		// 	//for landscape photo
		// 	// check width
		// 	if($originalWidth > 900){
		// 	$newwidth = 900;
		// 	$newheight = floor($newwidth/$ratio);

		// 	$new_size = imagecreatetruecolor($newwidth, $newheight);
			
		// 	imagecopyresized($new_size, $img, 0, 0, 0, 0, $newwidth, $newheight, $originalWidth, $originalHeight);
		// 	}else{	
		// 		$new_size = $img;
		// 	}
		// }else{
		// 	//for portrait photo
		// 	// check height 
		// 	if($originalHeight>750){

		// 		$newheight=550;
		// 		$newwidth = floor($newheight * $ratio);

		// 		$new_size = imagecreatetruecolor($newwidth, $newheight);
		
		// 		imagecopyresized($new_size, $img, 0, 0, 0, 0, $newwidth, $newheight, $originalWidth, $originalHeight);

		// 	}else{ $new_size = $img;}

		// }

  //       $new_size = $img;
        		
		// imagejpeg($new_size,$newPath.$newFilename, 70);

		//$img = $img->move($newPath, $newFilename);

		// $width = 1000;
		// $height = 1000;

		// if ($width/$height > $ratio) {
  //           $newwidth = $height*$ratio;
  //           $newheight = $height;
  //       } else {
  //           $newheight = $width/$ratio;
  //           $newwidth = $width;
  //       }

		if ($originalWidth > 3000 || $originalHeight > 3000){
			$percent_ratio = 0.99;
			$quality = 60;
		}else {
			$percent_ratio = 1;
			$quality = 80;
		}

		// $newwidth = $originalWidth*$percent_ratio;
		// $newheight = $originalHeight*$percent_ratio;

	 //    $dst = imagecreatetruecolor($newwidth, $newheight);
	 //    imagecopyresized($dst, $source, 0, 0, 0, 0, $newwidth, $newheight, $originalWidth, $originalHeight);

	    // imagejpeg($dst,$newPath.$newFilename, 60);
	    //imagedestroy($dst);
		
		//$img = $img->move($newPath, $newFilename);

		imagejpeg($source,$newPath.$newFilename, $quality);

		return $newPath.$newFilename;
	}

	private function image_fix_orientation($path)
	{
	    $image = imagecreatefromjpeg($path);
	    $exif = exif_read_data($path);

	    if (empty($exif['Orientation']))
	    {
	        return false;
	    }

	    switch ($exif['Orientation'])
	    {
	        case 3:
	            $image = imagerotate($image, 180, 0);
	            break;
	        case 6:
	            $image = imagerotate($image, - 90, 0);
	            break;
	        case 8:
	            $image = imagerotate($image, 90, 0);
	            break;
	    }

	    imagejpeg($image, $path);

	    return true;
	}
	
	private function createPlace(Request $request){
		$place = Place::where("lat",$request->place_lat)->where("lng",$request->place_lng)->first();
		if(count($place)==0){
		$place = New Place;
		$place->location = $request->location;
		$place->city = $request->city;
		$place->state = $request->state;
		$place->country = $request->country;
		$place->gplace_id = $request->gplace_id;
		$place->lat = $request->place_lat;
		$place->lng = $request->place_lng;
		$place->save();
		}else{
			$place->post_count +=1;
			$place->save();
		}
		return $place;
	}

	public function loadUserpost(){
		$pictures = Post::where('user_id',Auth::user()->id)->get();
		return view('auth.profile',compact('pictures'));
	}

	public function checkSearchInput(Request $request){
		$input = $request->search_input;
		/*
		$result = DB::table('places')
						->where('city','like',$input)
						->orWhere('location','like',$input)
						->orWhere('state','like',$input)
						->orWhere('country','like',$input)
						->distinct()
						->get();*/
		if ( $input != '' ){
			$result['city'] = DB::table('places')
							->select('city','country')
							->where('city','like','%'.$input.'%')
							->distinct()
							->get();

			if ( count($result['city']) == 0  ){
				$result['city'] = Array();
			}

			$result['location'] = DB::table('places')
						->select('location','city','country')				
						->where('location','like','%'.$input.'%')
						->distinct()
						->get();

			if ( count($result['location']) == 0  ){
				$result['location'] = Array();
			}

			$result['country'] = DB::table('places')
						->select('country')				
						->where('country','like','%'.$input.'%')
						->distinct()
						->get();

			if ( count($result['country']) == 0  ){
				$result['country'] = Array();
			}

		}else{
			$result['city'] = Array();
			$result['location'] = Array();
			$result['country'] = Array();
		}

		return $result;
	}

	public function sendAsk(Request $requests){

		$place_name = $requests->place;
		$city_name = $requests->city;
		$question = $requests->question;
		$question = '<a href="'.url('ask/answers/'.$question).'">'.$question.'</a>';

		if ($place_name == ''){

			// Store in Ask table
			$db_ask = New Ask;
			$db_ask->storeNewQuestion($requests);

			// Send question to city chatroom
			$message = $question;
			$related_id = $city_name;
			$type = 'city';

			$storeMessage = new Message;
	        $chatroom_id = Chatroom::firstOrCreate(['related_id'=>$related_id,'type'=>'city','name'=>$city_name])->first();
	        $chatroom_id = $chatroom_id->id;

	        $storeMessage->message = $message;
	        $storeMessage->chatroom_id = $chatroom_id;
	        $ask_id = User::where('user','ask')->first();
	        $ask_id = $ask_id->id;
	        $storeMessage->user_id = $ask_id;
	        $storeMessage->save();

	        return back();
		}else {
			return back();
		}

		// // Check place is null
		// if( $place == '' ){
		// 	// Get user email list with 

		// 	// Check if city exists in table

		// 	// check picture table
		// 	$email_list = DB::table('pictures')
		// 	                               ->join('places','pictures.place_id','=','places.id')
		// 	                               ->join('users','pictures.user_id','=','users.id')
		// 	                               ->select('users.email','users.user')
		// 	                               ->where('places.city',$city)
		// 	                               ->distinct()
		// 	                               ->get();

		// 	// user visited recently

		// 	// all list

		// 	// 

		// }else{
		// 	$email_list = DB::table('pictures')
		// 	                               ->join('places','pictures.place_id','=','places.id')
		// 	                               ->join('users','pictures.user_id','=','users.id')
		// 	                               ->select('users.email','users.user')
		// 	                               ->where('places.city',$city)
		// 	                               ->where('places.location',$place)
		// 	                               ->distinct()
		// 	                               ->get();
		// }

		// // Record data in ask table


		// return view('/ask',compact('email_list'));
	}


	public function saveEditMypost($post_id, Request $requests){

		$post_id = base64_decode($post_id);
		
		$user = Auth::user();
		$db_post = Post::where('user_id',$user->id)
					   ->where('id',$post_id)
					   ->first();

		// Check Tags
		$req_tags = $requests->tags;
		$db_tags = $db_post->tag;
		$leng_db_tags = count($db_tags);
		$temp_db_tags = array();

		foreach ($db_post->tag as $tag){
			array_push($temp_db_tags, $tag->type);
		}

		if ( $req_tags != '' ){

			// Remove possible white space and store each tag to an array
			$req_tags = str_replace(" ","",$req_tags);
			$req_tags = str_replace("##","#",$req_tags);
			$req_tags = substr($req_tags,1);
			$tags = explode("#",$req_tags);
			$temp_tags = $tags;

			if ( $leng_db_tags > 0 ){

				foreach($tags as $tag){

					for ( $i = 0; $i < $leng_db_tags; $i++ ){

						$db_tag_type = $db_tags[$i]->type;

						if ( $tag == $db_tag_type ){

							// Remove one entry 
							unset( $temp_tags );
							unset( $temp_db_tags[$i] );
							$i = 100;

						}

		            }

	            }

	        }

	        if (isset($temp_tags)){
	            // Store new tags
	            foreach ( $temp_tags as $tag ){
	            	$store = new Tag;
		            $store->type = $tag;
		            $store->post_id = $post_id;
		            $store->save();
	            }
	        }

		}

		// Check if there is a removed tag from previous
        if ( count($temp_db_tags) > 0 ){

        	foreach ($temp_db_tags as $temp_tag){

        		$delete_tag = Tag::where('type',$temp_tag)
        		                 ->where('post_id',$post_id)
        		                 ->first();

        		$delete_tag->delete();

        	}
    
        }   // Checking tag is done

		if ( $db_post->title != $requests->title || $db_post->comment != $requests->comment ){

			$update_post = Post::where('user_id',$user->id)
						       ->where('id',$post_id)
						       ->update([
						    		'title' => $requests->title,
						    		'comment' => $requests->comment
						    	]);

		}


		return redirect('/me/mypage/post/view/'.$post_id);


	}

	public function placenowAjax(Request $request){

		// Store current_time_in_sec in Session
		$current_time_in_sec = $request->current_time_in_sec;
		$request->session()->put('current_time_in_sec', $current_time_in_sec);

	}

	
}