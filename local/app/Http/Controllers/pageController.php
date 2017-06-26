<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Place;
use App\Post;
use App\User;
use App\Follow;
use App\Chatroom;
use App\City;
use App\CityFollow;
use App\Tag;
use App\Ask;
use Auth;
use Socialite;
use App\SocialAccountService;
use Session;


class pageController extends Controller
{

	public function welcome(Request $request){
		
		// Latest
		$picture = New Post;
		$latest = $picture->latestPicture();

		// Best
		// $most_popular = DB::table('pictures')
		// 						->orderBy('pictures.updated_at','desc')
		// 						->orderBy('pictures.vote_count','desc')
		// 						->take(3)
		// 						->get();
		// $most_popular = Picture::orderBy('created_at','desc')
		// 					   ->orderBy('vote_count','desc')
		// 					   ->where('title','<>','')
		// 					   ->where('comment','<>','')
		// 					   ->take(10)
		// 					   ->get();

		// if (count($most_popular)==0){
		// 	$most_popular = Picture::orderBy('created_at','desc')
		// 						   ->orderBy('vote_count','desc')
		// 						   ->take(10)
		// 						   ->get();
		// }
		
		$most_popular = Post::orderBy('created_at','desc')
								   ->orderBy('vote_count','desc')
								   ->take(30)
								   ->get();

		$today = date( "Y-m-d H:i:s", mktime(0, 0, 0) );

		// Popular City
		$popular_citie_list = DB::table('posts')
										->join('places','posts.place_id','=','places.id')
										//->where( 'pictures.created_at', '>=', $today)
										->orderBy('posts.created_at', 'desc')
										->select(DB::raw('places.id,places.city, count(places.city) as city_count'))
										->orderBy('city_count','desc')
										->take(1)
										->get();

		// if ($popular_cities[0]->city_count != 0){
			
			
		// }else{
		// 	$popular_cities = DB::table('pictures')
		// 							->join('places','pictures.place_id','=','places.id')
		// 							->orderBy('pictures.created_at', 'desc')
		// 							->select(DB::raw('places.id,places.city, count(places.city) as city_count'))
		// 							->orderBy('city_count','desc')
		// 							->take(4)
		// 							->get();
		// }
		
		$popular_cities_leng = count($popular_citie_list);

		$popular_city = array();

		for ($i = 0; $i < $popular_cities_leng; $i++){
			$ppc_picture = Post::join('places','posts.place_id','=','places.id')
											->select('posts.*','places.*')
											->where('places.city','=',$popular_citie_list[$i]->city)
											->orderby('posts.updated_at','desc')
											->orderby('posts.vote_count','desc')
											->first();

		    if ($ppc_picture != null){
				array_push($popular_city,$ppc_picture);
			}else{
				// if there is no 
			}
		}

		


		// Load Popular place

		$popular_place_list = DB::table('posts')
									   ->select(DB::raw('place_id, count(place_id) as location_count'))
									   ->groupBy('place_id')
									   ->orderBy('location_count','desc')
									   ->take(7)
									   ->get();

		$popular_place = array();

									   

		for ($j = 0; $j < count($popular_place_list); $j++){
			$temp_pic = Post::join('places','posts.place_id','=','places.id')
								->select('posts.*')
								->where('places.id','=',$popular_place_list[$j]->place_id)
								->orderby('posts.updated_at','desc')
								->orderby('posts.vote_count','desc')
								->first();

		    if ($temp_pic != null){
				array_push($popular_place,$temp_pic);
			}else{
				// if there is no 
			}
		}

		// Popular tags
		//$popular_tag = Tag::all();
		$today = date( "Y-m-d H:i:s", mktime(0, 0, 0) );

		$popular_tag = Tag::select(DB::raw('id,type, count(type) as type_count'))
						  ->groupBy('type')
						  //->where('created_at','>=',$today)
						  ->orderBy('type_count','desc')
						  ->take(4)
						  ->get();

		// $popular_tag_pic = array();	
 
 	// 	for ($j = 0; $j < count($popular_tag); $j++){
		// 	$temp_pic = Picture::join('tags','pictures.id','=','tags.picture_id')
		// 						->select('pictures.*')
		// 						->where('tags.type','=',$popular_tag[$j]->type)
		// 						->orderby('pictures.updated_at','desc')
		// 						->orderby('pictures.vote_count','desc')
		// 						->first();

		//     if ($temp_pic != null){
		// 		array_push($popular_tag_pic,$temp_pic);
		// 	}else{
		// 		// if there is no 
		// 	}
		// }

		$db_ask = New Ask;
		$popularQuestion = $db_ask->popularQuestion();



		return view('welcome2',compact(	
									'most_popular',		
									'latest',
									'best_place',
									'popular_city',
									'popular_place',
									'popular_tag',
									'popularQuestion'
									// 'popular_tag_pic'
								));

	}

	public function tag(){

		$latest_pictures = Post::orderBy('created_at','desc')->take(10)->get();
		$popular_pictures = Post::select(DB::raw('posts.* ,(posts.vote_count + posts.favor_count + posts.recommend_count + posts.view_count) as sum'))
							 ->orderBy('sum','desc')
							 ->take(10)
							 ->get();

		$tags = new Tag;
		$tags = $tags -> getTagsOnCount(10);
		

		Session::put('test','num1');
		$sessions = Session::all();


		return view('tag.tag_best',compact(
									'latest_pictures',
									'popular_pictures',
									'tags','sessions'
								));

	}

	public function index(){
		if (Auth::user()){
			return redirect('/welcome');
		}else{
			$latest_picture = Post::orderBy('updated_at', 'desc')->take(30)->get();
			return view('index',compact('latest_picture'));
		}
	}

	public function showMypage(Request $request){
		$db_user = Auth::user();

		$auth_id = $db_user->id;

		// time 24 hours ago
		$current_time_in_sec = $request->session()->get('current_time_in_sec',0);
		$user_today_time = (new \DateTime())->modify('-'.$current_time_in_sec.' seconds');


		// From vote history 
		//$vote_history = Post::

		$mypost = Post::join('users','posts.user_id','=','users.id')
					  ->join('places','posts.place_id','=','places.id')
					  ->select('posts.*','places.city','places.location','users.user')
					  ->where('posts.user_id','!=',$auth_id)
					  ->where('posts.created_at','>',$user_today_time)
					  ->orderBy('id','desc')
					  ->get();

		if ( count($mypost) == 0 ){
			$mypost = Post::join('users','posts.user_id','=','users.id')
					  	  ->join('places','posts.place_id','=','places.id')
					      ->select('posts.*','places.city','places.location','users.user')
						  ->where('posts.user_id',$auth_id)
						  ->orderBy('id','desc')
				       	  ->take(10)
						  ->get();
		}

		$follow_user = Post::join('follows','posts.user_id','=','follows.follow_id')
					       ->join('users','posts.user_id','=','users.id')
					       ->join('places','posts.place_id','=','places.id')
						   ->select('posts.*','places.city','places.location','users.user')
					       ->where('follows.user_id',$auth_id)
						   ->where('posts.created_at','>',$user_today_time)
						   ->orderBy('id','desc')
			               ->get();

		if ( count($follow_user) == 0 ){
			$follow_user = Post::join('follows','posts.user_id','=','follows.follow_id')
					       ->join('users','posts.user_id','=','users.id')
					       ->join('places','posts.place_id','=','places.id')
						   ->select('posts.*','places.city','places.location','users.user')
					       ->where('follows.user_id',$auth_id)
					       ->orderBy('id','desc')
					       ->take(10)
			               ->get();
		}

		//$list_following_city = CityFollw::join

		$follow_city = Post::join('places','posts.place_id','=','places.id')
						   ->join('cities','cities.city','=','places.city')
						   ->join('city_follows','city_follows.city_id','=','cities.id')
						   ->join('users','posts.user_id','=','users.id')
						   ->select('posts.*','places.city','places.location','users.user')
						   ->where('city_follows.user_id',$auth_id)
						   ->where('posts.user_id','!=',$auth_id)
						   ->where('posts.created_at','>',$user_today_time)
						   ->orderBy('id','desc')
						   ->get();

		if ( count($follow_city) == 0 ){
			$follow_city = Post::join('places','posts.place_id','=','places.id')
							   ->join('cities','cities.city','=','places.city')
							   ->join('city_follows','city_follows.city_id','=','cities.id')
							   ->join('users','posts.user_id','=','users.id')
							   ->select('posts.*','places.city','places.location','users.user')
							   ->where('city_follows.user_id',$auth_id)
							   ->where('posts.user_id','!=',$auth_id)
							   ->orderBy('id','desc')
					       	   ->take(10)
							   ->get();
		}

		$follow_place = Post::join('places','posts.place_id','=','places.id')
						    ->join('place_follows','place_follows.place_id','=','places.id')
						    ->join('users','posts.user_id','=','users.id')
						    ->select('posts.*','places.city','places.location','users.user')
						    ->where('place_follows.user_id',$auth_id)
						    ->where('posts.user_id','!=',$auth_id)
						    ->where('posts.created_at','>',$user_today_time)
						    ->orderBy('id','desc')
						    ->get();
 
 		if ( count($follow_place) == 0 ){
 			$follow_place = Post::join('places','posts.place_id','=','places.id')
							    ->join('place_follows','place_follows.place_id','=','places.id')
							    ->join('users','posts.user_id','=','users.id')
							    ->select('posts.*','places.city','places.location','users.user')
							    ->where('place_follows.user_id',$auth_id)
							    ->where('posts.user_id','!=',$auth_id)
							    //->where('posts.created_at','>',$user_today_time)
							    ->orderBy('id','desc')
							    ->take(10)
							    ->get();
 		}

		// Sort and merge arrays
		$posts = array();

		$leng_mypost = count($mypost);
		$leng_fUser = count($follow_user);
		$leng_fCity = count($follow_city);
		$leng_fPlace = count($follow_place);

		$sum_all = $leng_fCity + $leng_fUser + $leng_fPlace + $leng_mypost;

		$count_fUser = 0;
		$count_fCity = 0;
		$count_fPlace = 0;
		$count_mypost = 0;
		$count_post = 0;


		while ( $sum_all != 0 ) {

			if($count_mypost < $leng_mypost){$id_mp = $mypost[$count_mypost]->id;}
			else{$id_mp = -1;}
			if($count_fUser < $leng_fUser){$id_fu = $follow_user[$count_fUser]->id;}
			else{$id_fu = -1;}
			if($count_fCity < $leng_fCity){$id_fc = $follow_city[$count_fCity]->id;}
			else{$id_fc = -1;}
			if($count_fPlace < $leng_fPlace){$id_fp = $follow_place[$count_fPlace]->id;}
			else{$id_fp = -1;}
			
			$max_value = max($id_mp,$id_fu,$id_fc,$id_fp);
			$chosen_type = '';
			$chosen_table = null;
			$chosen_count = 0;

			switch ($max_value) {
				case $id_mp:
					$chosen_type = 'mypost';
					$chosen_table = $mypost;
					$chosen_count = $count_mypost;
					$count_mypost++;
					$sum_all--;
					break;

				case $id_fu:
					$chosen_type = 'fUser';
					$chosen_table = $follow_user;
					$chosen_count = $count_fUser;
					$count_fUser++;
					$sum_all--;
					if ( $id_fu == $id_fc && $id_fu == $id_fp ){
						$count_fCity++;
						$count_fPlace++;
						$sum_all = $sum_all - 2;
					}else if ( $id_fu == $id_fc ){
						$count_fCity++;
						$sum_all--;
					}
					break;

				case $id_fc:
					$chosen_type = 'fPlace';
					$chosen_table = $follow_city;
					$chosen_count = $count_fCity;
					$count_fCity++;
					$sum_all--;
					if ( $id_fc == $id_fp ){
						$count_fPlace++;
						$sum_all--;
					}
					break;

				case $id_fp:
					$chosen_type = 'fCity';
					$chosen_table = $follow_place;
					$chosen_count = $count_fPlace;
					$count_fPlace++;
					$sum_all--;
					break;
				
				default:
					# code...
					break;
			}

			$this->addColToPost($posts, $chosen_table , $chosen_count, $user_today_time, $chosen_type);
			array_push( $posts, $chosen_table[$chosen_count] );

		}// End of While

		return view('mypage.mypage',compact('posts'));
	}

	private function addColToPost($post_arry, $type_arry , $count, $time, $type){
		// mypost is most recent
		if ($type_arry[$count]->created_at > $time){
			//it is today
			$type_arry[$count]->today = 'yes';
		}else{
			$type_arry[$count]->today = 'no';
		}
		$type_arry[$count]->post_type = $type;
		//array_push($post, $type_arry[$count]);
	}

	public function showMypost(){
		$posts = Post::where('user_id',Auth::user()->id)->get();

		return view('mypage.mypost',compact('posts'));
	}

	public function showViewMypost($post_id){

		$post_id = base64_decode($post_id);

		$post = Post::where('user_id',Auth::user()->id)
					 ->where('id',$post_id)
					 ->first();

		return view('mypage.viewmypost',compact('post'));
	}

	public function showEditMypost($post_id){

		$post_id = base64_decode($post_id);

		$post = Post::where('user_id',Auth::user()->id)
					 ->where('id',$post_id)
					 ->first();

		return view('mypage.editmypost',compact('post'));
	}

	public function showMyaccount(){
		$db_user = Auth::user();

		return view('auth.myaccount',compact('db_user'));
	}

	
	public function showProfile(){

		$pictures = Post::where('user_id',Auth::user()->id)->get();

		return view('auth.profile',compact('pictures'));

	}
	public function showUser($user){
		$user_id = User::where('user', $user)->first();
		if (count($user_id)){
			$follow_list = Follow::where('user_id', $user_id)->get();
			$list_follow_id = array();
			for ($i = 0; $i < count($follow_list); $i++) {
				array_push($list_follow_id, ['user_id' => $follow_list[$i]->follow_id]);
			}
			$pictures = Post::where($list_follow_id)
							   ->orderBy('created_at','desc')
							   ->get();
		}

		return view('user',compact('pictures'));
	}
	public function management(){

		$pictures = Post::all();
		$places = Place::all();
		$users = User::all();
		$chatrooms = Chatroom::all();

		return view('auth.manage',compact('pictures','places','users','chatrooms'));

	}
	public function showCityPage( $city ){
		// We search for place in database.
		// If not in the database, then try to find closest name from database.
		// If still can't find with an algorithm, then tell the user that we can't locate place.
		// Ask user if wants to report.

		if (Auth::user()){
			$user_id = Auth::user()->id;
		}else{
			$user_id = -1;
		}
		$city_id = City::select('id')->where('city',$city)->first();
		if (count($city_id)!=1){
			$city_id = -2;
		}else{
			$city_id = $city_id->id;
		}

		$pictures = new Place;
		$pictures = $pictures->picture_ByCity($city);

		$city_ary = array( 'city' => $city );

		$db_cities = City::where('city',$city)->first();
		if (count($db_cities) != 0) {
			$city_ary['follow_count'] = $db_cities->follow_count;
			$city_ary['post_count'] = $db_cities->post_count;
		}else {
			$city_ary['follow_count'] = '0';
			$city_ary['post_count'] = '0';
		}

		if ( count(CityFollow::where('city_id',$city_id)->where('user_id',$user_id)->first()) == 1 ){
			$city_ary['user_follow_city'] = 'yes';
		}else {
			$city_ary['user_follow_city'] = 'no';
		}

		// Most Popular
		// $most_popular = Picture::join('places','pictures.place_id','=','places.id')
		// 					   ->orderBy('pictures.created_at','desc')
		// 					   ->orderBy('vote_count','desc')
		// 					   ->where('places.city',$city)
		// 					   ->where('title','<>','')
		// 					   ->where('comment','<>','')
		// 					   ->take(4)
		// 					   ->get();

		// if (count($most_popular)==0){
			$most_popular = Post::join('places','posts.place_id','=','places.id')
								   ->select('posts.*')
								   ->where('places.city',$city)
								   ->orderBy('posts.created_at','desc')
								   ->orderBy('vote_count','desc')
								   // ->where('places.city',$city)
								   ->take(30)
								   ->get();
		//}


		// Load Popular place

		$popular_place_list = DB::table('posts')
									   ->join('places','places.id','=','posts.place_id')
									   ->select(DB::raw('posts.id,places.location, count(places.id) as location_count'))
									   ->where('places.city',$city)
									   ->groupBy('places.location')
									   ->orderBy('location_count','desc')
									   ->take(4)
									   ->get();

		$popular_place = array();							   

		for ($j = 0; $j < count($popular_place_list); $j++){
			$temp_pic = Post::join('places','posts.place_id','=','places.id')
								->select('posts.*','places.*')
								->where('places.location','=',$popular_place_list[$j]->location)
								->orderby('posts.updated_at','desc')
								->orderby('posts.vote_count','desc')
								->first();

		    if ($temp_pic != null){
				array_push($popular_place,$temp_pic);
			}else{
				// if there is no 
			}
		}

		// Popular tags
		//$popular_tag = Tag::all();
		$today = date( "Y-m-d H:i:s", mktime(0, 0, 0) );

		$popular_tag = Tag::join('posts','posts.id','=','tags.post_id')
						  ->join('places','posts.place_id','=','places.id')
						  ->where('places.city',$city)
						  ->select(DB::raw('type, count(type) as type_count'))
						  ->groupBy('type')
						  //->where('created_at','>=',$today)
						  ->orderBy('type_count','desc')
						  ->take(4)
						  ->get();

		$popular_tag_pic = array();	
 
 		for ($j = 0; $j < count($popular_tag); $j++){
			$temp_pic = Post::join('tags','posts.id','=','tags.post_id')
								->select('posts.*')
								->where('tags.type','=',$popular_tag[$j]->type)
								->orderby('posts.updated_at','desc')
								->orderby('posts.vote_count','desc')
								->first();

		    if ($temp_pic != null){
				array_push($popular_tag_pic,$temp_pic);
			}else{
				// if there is no 
			}
		}

		// Popular question in city
		$db_ask = New Ask;
		$popularQuestion = $db_ask->popularQuestioninCity($city);


		// Latest
		$latest = Post::join('places','posts.place_id','=','places.id')
						 ->select('posts.*')
						 ->where('places.city',$city)
						 ->orderby('posts.created_at','desc')
						 ->take(30)
						 ->get();


		return view('city')->with( compact( 'pictures',
											'city_ary',
											'most_popular',
											'popular_place',
											'popular_tag',
											'popular_tag_pic',
											'popularQuestion',
											'latest' 
											) 
		);

	}

	public function showYourCityPage(){
		
	}

	public function showNearby(){

		/* Get place nearby user's current location */
		$user_pos = DB::table('positions')
									->where('user_id',Auth::user()->id)
									->orderBy('id','desc')
									->first();

		$lat = $user_pos->lat;
		$lng = $user_pos->lng;

		$nearbyplace_picture = Post::join('places','places.id','=','posts.place_id')
									  ->select(DB::raw('posts.*,places.location, ( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( places.lat ) ) * cos( radians( places.lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( places.lat ) )  )  ) as distance') )
									  ->having('distance', '<', 20)
									  ->orderBy('posts.created_at','desc')
									  ->orderBy('posts.vote_count')
									  ->orderby('distance') 
									  ->take(30)
									  ->get();


		return view('nearby')->with( compact( 'nearbyplace_picture') );
	}



	public function showStatePage($state){

	}
	public function showPlacePage($Load_place){

	}
	public function showTagPage($tag){
		$tag_pictures = new Tag;
		$tag_pictures = $tag_pictures->loadPicturefromtype($tag);
		$select_tag = array('tag'=>$tag);
		return view('tag.tag')->with(compact('tag_pictures','select_tag') );
	}

	public function sortPictures($sort,Request $request){
		
		$request->session()->put('sortIndex', $sort);
		return redirect('/');
	}

	public function showPeoplePage($username){
		$username = array('username'=>$username);		
		$user_id = User::where('user',$username)->first()->id;
		$auth_id = Auth::user()->id;
	
		$ch_follow = New User;
		$ch_follow = $ch_follow->checkFollow($user_id,$auth_id);
		$username['same'] = $ch_follow['same'];
		$username['record'] = $ch_follow['record'];

		if(count($user_id)){


			$username['post_count'] = Post::where('user_id',$user_id)->count();
			$username['following_count'] = Follow::where('user_id',$user_id)->count();
			$username['follower_count'] = Follow::where('follow_id',$user_id)->count();

			

			$following_list = Follow::where('user_id',$user_id)
									->join('users','follows.user_id','=','users.id')
									->select('users.*')
									->get();
			$follower_list = Follow::where('follow_id',$user_id)
									->join('users','follows.user_id','=','users.id')
									->select('users.*')
									->get();

			$pictures = Follow::where('follows.user_id',$user_id)
							  ->join('posts','posts.user_id','=','follows.follow_id')
							  ->select('posts.*')
							  ->orderBy('created_at','desc')
							  ->get();


			return view('people',compact('username','following_list','follower_list','pictures'));

		}else{

			return redirect('/');
		}		
	}

	public function showAnswers($question){

		$db_ask = Ask::where('question',$question)->get();

		return view( 'ask_answer', compact('db_ask') );

	}
	public function sendAsk(Request $requests){

		$place_name = $requests->place;
		$city_name = $requests->city;
		$question = $requests->question;
		$question = '<a href="">'.$question.'</a>';

		if ($place_name == ''){

			// Send question to city chatroom
			$message = $question;
			$related_id = $city_name;
			$type = 'city';

			$storeMessage = new Message;
	        $chatroom_id = Chatroom::where('related_id',$related_id)->first();
	        $chatroom_id = $chatroom_id->id;

	        $storeMessage->message = $message;
	        $storeMessage->chatroom_id = $chatroom_id;
	        $storeMessage->user_id = User::where('user','ask')->get()->user_id;
	        $storeMessage->save();

	        return back();
		}else {
			return back();
		}

	}

	// Google sign-in
    public function socialRedirect(){
        return Socialite::driver('google')->redirect();
    }

    public function socialCallback(SocialAccountService $service){
        $user = $service->createOrGetUser(Socialite::driver('google')->user());

        auth()->login($user);

        return redirect('/');
    }

    public function nearby(){
    	/* Get place nearby user's current location */
    	$user_pos = DB::table('positions')
									->where('user_id',Auth::user()->id)
									->orderBy('id','desc')
									->first();

		$lat = $user_current_pos->lat;
		$lng = $user_current_pos->lng;

		$nearbyplace_picture = DB::table('places')
								->join('posts','places.id','=','posts.place_id')
								->select(DB::raw('posts.id,posts.pic_location, ( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( places.lat ) ) * cos( radians( places.lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( places.lat ) )  )  ) as distance') )
								->having('distance', '<', 50)
								->orderby('distance') 
								->take(6)
								->get();

		// Load what's happening in city where user is  -- Popular place
		$city = '';
		$city = $user_current_pos->city;
    }
}
