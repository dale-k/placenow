<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function picture(){
        return $this->hasMany(Post::class);
    }
    public function comment(){
        return $this->hasMany(Comments::class);
    }
    public function message(){
        return $this->hasMany(Message::class);
    }
    public function votehistory($picture_id){
        return $this->hasMany(votehistory::class)->where('picture_id',$picture_id)->first();
    }
    public function position(){
        return $this->hasMany(Position::class);
    }

    public function getPicturewithvote(){
        $picture = Post::all();
    }
    public function getUserCity(){
      if( $this->hasMany(Position::class)->exists() ) {
        return $this->hasMany(Position::class)->orderBy('created_at','desc')->first()->city;
      }else {
        return '';
      }

    }
    
    public function chkFollowList($user_ids){
      $list = array();
      for($i = 0; $i<count($user_ids);$i++){
      $row = $this->following($user_ids[$i]);
      array_push($list,$row);
      }
      return $list;
    }

    public function following($user_id){
      $result = Follow::where('user_id',Auth::user()->id)
                      ->where('follow_id',$user_id)
                      ->first();
      if($user_id == Auth::user()->id){
        $result = -1;
      }else if(count($result)==0){
        $result = 0;
      }else{
        $result = 1;
      }


      return $result;
    }
}
