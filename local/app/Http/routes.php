
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// First Page ( index )
Route::get('/', 'pageController@welcome');

// show sorting picture
Route::auth();
Route::get('/sort/{sort}','pageController@sortPictures');

// Google Sign-in
Route::get('/redirect', 'pageController@socialRedirect');
Route::get('/callback', 'pageController@socialCallback');

// Welcome Page
Route::get('/welcome', 'pageController@welcome');

// City
Route::get('/city/{city}', 'pageController@showCityPage');

// Tag
Route::get('/tag','pageController@tag');
Route::get('/tag/{tag}','pageController@showTagPage');

// Tag detail
Route::get('/tag/{tag}/top','tagController@loadTopTag');
Route::get('/tag/{tag}/live','tagController@loadLiveTag');
Route::get('/tag/{tag}/location','tagController@loadLocationTag');
Route::get('/tag/{tag}/more','tagController@loadMoreTag');


Route::group(['middleware' => 'auth'], function () {

	Route::get('/test','pageController@test');
    
    //Position
    Route::post('/storepositions','positionController@storePosition');
    
	//Management
    Route::get('/management','pageController@management');

    // Me Page
    Route::get('/me/mypage',"pageController@showMypage");
    Route::get('/me/mypage/post',"pageController@showMypost");
    Route::get('/me/mypage/post/view/{id}',"pageController@showViewMypost");
    Route::get('/me/mypage/post/edit/{id}',"pageController@showEditMypost");
    Route::post('/me/mypage/post/saveEdit/{id}',"dataController@saveEditMypost");

    Route::get('/me/myaccount',"pageController@showMyaccount");
	Route::get('/me/profile',"pageController@showProfile");

	Route::get('/user/{user}',"pageController@showUser");
	
	// Follow
	Route::get('/follow/{username}','userController@follow');
	Route::get('/unfollow/{username}','userController@unfollow');

	Route::get('/followcity/{city}','userController@followcity');
	Route::get('/unfollowcity/{city}','userController@unfollowcity');

	// // State
	// Route::get('/state/{state}','pageController@showStatePage');
	// Place
	Route::get('/nearby','pageController@showNearby');
	Route::get('/place/{Load_place}','pageController@showPlacePage');


	// Vote
	Route::post('/vote',"voteController@selePicutre");

	// Postmyphoto
	Route::get('/postmyphoto',function(){
		return view('uploadmyphoto');
	});
	Route::post('/postmyphoto',"dataController@savePost");

	// Ask
	Route::get('/ask/answers/{question}','pageController@showAnswers');
	Route::post('/ask/sendQuestion','dataController@sendAsk');

	// Search
	Route::post('/search','dataController@checkSearchInput');

	// Photo
	Route::get('/photo/{photoID}','pictureController@showPhoto');
	

	// Placenow ajax
	Route::post('/ajax','dataController@placenowAjax');
	

	// Chat
	Route::get('/chat',"msgController@loadPublicMessage");
		//chat-nearby
	Route::get('/chat/nearby',"msgController@loadNearbyMessage");
		//chat-city
	Route::get('/chat/city/{city}',"msgController@loadCityMessage");
		//chat-place
			// load
	Route::get('/chat/locationload',"msgController@loadLocationMessage");
			// get chatroom
	Route::post('/chat/findroom',"msgController@findRoom");
			// show msg
	Route::get('/chat/place/{place}',"msgController@loadPlaceMessage");

	
	// ajax loading and storing Chat
	Route::post('/loadchat',"msgController@ajaxLoadMessage");
	Route::post('/chatstore','msgController@storeMessage');
	Route::post('/checkchatrooms','msgController@checkChatroom');


	// People
	Route::get('/ppl/{username}','pageController@showPeoplePage');

});












