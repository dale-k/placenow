<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
class Post extends Model
{

    public function place(){
    	return $this->belongsTo(Place::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function comment(){
        return $this->hasMany(Comments::class);
    }
    
    public function tag(){
        return $this->hasMany(Tag::class);
    }
    public function getPicturesbyTag($tag){
        
    }

    public function votehistory(){
        //return $this->belongsToMany('App\User','votehistories')->withPivot('voted','favored','recommended');
        return $this->hasMany('App\Votehistory');
    }

    public function latestPicture(){
        return $this->orderBy('created_at', 'desc')->take(20)->get();
    }

    public function loadOnePicture($id){
        return $this->where('id',$id)->first();
    }

    public function loadBeforePicture($id){
        $now = $this->loadOnePicture($id);

        $place =$now->place->location;

        $picture_before =$this
                        ->join('places','posts.place_id','=','places.id')
                        ->where('places.location',$place)
                        ->where('posts.created_at','<',$now->created_at)
                        ->select('posts.*')
                        ->orderBy('posts.created_at','desc')
                        ->take(5)
                        ->get();


        if(count($picture_before)<5){
            $nearby_picture = $this->getNearbyPictures($now,0);
            $picture_before = $nearby_picture;
        }
        $picture_before = $picture_before->sortBy('id');
        return $picture_before;
    }

    public function loadAfterPicture($id){
        $now = $this->loadOnePicture($id);

        $place =$now->place->location;

        $picture_after = $this->join('places','posts.place_id','=','places.id')
                                ->where('places.location',$place)
                                ->select('posts.*')
                                ->where('posts.created_at','>',$now->created_at)
                                ->orderBy('posts.created_at','asc')
                                ->take(5)
                                ->get();

        if(count($picture_after)<5){
            
            $nearby_picture = $this->getNearbyPictures($now,1);
            $picture_after = $nearby_picture;
        }


        return $picture_after;
       

    }

    public function getNearbyPictures(Post $now,$time){
        

        $lat = $now->place->lat;
        $lng = $now->place->lng;
        if($time==0){// before now
        $nearbyplace_picture = $this->join('places','places.id','=','posts.place_id')
                                    ->select(DB::raw('posts.*,places.location, ( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( places.lat ) ) * cos( radians( places.lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( places.lat ) )  )  ) as distance') )
                                    ->having('distance', '<', 20)
                                    ->where('posts.id','<>',$now->id)
                                    ->where('posts.created_at','<',$now->created_at)
                                    ->orderby('posts.created_at','desc')
                                    ->orderby('distance')
                                    ->take(5)
                                    ->get();
        }else{ // after now
        $nearbyplace_picture = $this->join('places','places.id','=','posts.place_id')
                                    ->select(DB::raw('posts.*,places.location, ( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( places.lat ) ) * cos( radians( places.lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( places.lat ) )  )  ) as distance') )
                                    ->having('distance', '<', 100)
                                    ->where('posts.id','<>',$now->id)
                                    ->where('posts.created_at','>',$now->created_at)
                                    ->orderby('posts.created_at','asc')
                                    ->orderby('distance')
                                    ->take(5)
                                    ->get();    
        }
        return $nearbyplace_picture;
    }


}
 