<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Place;
use App\Picture;
use App\User;
use App\Follow;
use App\Chatroom;
use App\Tag;
use Auth;


class tagController extends Controller
{
	public function loadTopTag($tag){
		

		$toptag_pictures = Post::join('tags','tags.picture_id','=','posts.id')
								  ->where('tags.type',$tag)
								  ->select(DB::raw('posts.* , (posts.vote_count+posts.favor_count+posts.recommend_count+posts.view_count) as count '))
								  ->orderBy('count','desc')
								  ->take(12)
								  ->get();
		

		
		$select_tag = array('tag'=>$tag);
		
		return view('tag.top')->with(compact('toptag_pictures','select_tag') );	
	}

	public function loadLiveTag($tag){

		$livetag_pictures = Post::join('tags','tags.picture_id','=','posts.id')
								  ->where('tags.type',$tag)
								  ->select('posts.*')
								  ->orderBy('posts.created_at','desc')
								  ->take(12)
								  ->get();
		
		$select_tag = array('tag'=>$tag);
		
		return view('tag.live')->with(compact('livetag_pictures','select_tag') );
	}

	public function loadLocationTag($tag){

		$loctag_pictures = Place::join('posts','posts.place_id','=','places.id')
		->join('tags','tags.picture_id','=','posts.id')
		->where('tags.type',$tag)
		->select(DB::raw('places.*'))
		->groupBy('places.location')
		->take(4)
		->get();

		$select_tag = array('tag'=>$tag);
		
		return view('tag.location')->with(compact('loctag_pictures','select_tag') );
	}

	public function loadMoreTag($tag_selected){

		$tags_more = Tag::where('type','like','%'.$tag_selected.'%')
				   ->where('type','<>',$tag_selected)
				   ->take(12)
				   ->get();
		if(count($tags_more)<12){
		
			$tags = new Tag;
			$tags_related = $tags -> getTagsOnCount(12-count($tags_more));

			$tags_more->push($tags_related);
		}
		$toptags_pictures = array();
		foreach($tags_more[0] as $tag){
			$row = $tag->TopPicture($tag->type);
			array_push($toptags_pictures , $row);
		}

		
		$select_tag = array('tag'=>$tag_selected);
		
		return view('tag.more')->with(compact('tags_more','select_tag','toptags_pictures') );
	}
}