<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class Tag extends Model
{
    public function TopPicture($type){
       $picture = Post::join('tags','posts.id','=','tags.post_id')
                       ->select(DB::raw('posts.* ,(posts.vote_count + posts.favor_count + posts.recommend_count + posts.view_count) as sum'))
                       ->where('tags.type',$type)
                       ->orderBy('sum','desc')
                       ->first();
        return $picture;
    }
    public function storeNewTag($picture_id,$string){
        // do all the protection  , trim / take out additonal white space / change all to lowercase
        // $string = strtolower($string);
        $string = str_replace("   "," ",$string);
        $string = str_replace("  "," ",$string);
        $string = trim($string);

        

        if ( $string != '' ){

            $tags = explode(" ",$string);

            foreach($tags as $tag){
                $store = new Tag;
                $store->type =substr($tag,1);
                $store->post_id = $picture_id;
                $store->save();
            }
        }

    }
    public function loadTopPicturefromtype(){
       return $this->hasMany(Post::class)->select(DB::raw('posts.* ,(posts.vote_count + posts.favor_count + posts.recommend_count + posts.view_count) as sum'))
                    ->orderBy('sum','desc')
                    ->first();
    }
    public function loadPicturefromtype($type){
        $pictures = Post::join('tags','posts.id','=','tags.post_id')
                       ->select('posts.*')
                       ->where('tags.type',$type)
                       ->orderBy('created_at','desc')
                       ->take(12)
                       ->get();
    
        return $pictures;
    
    }
    public function getTagsRelated($type){
        $pictures = $this->where('type','like','%'.$type.'%')->get();

    }
    public function getTagsOnCount($num){
        $tags = $this->join('posts','tags.post_id','=','posts.id')
                     ->select(DB::raw('tags.* , posts.pic_location,(posts.vote_count + posts.favor_count + posts.recommend_count + posts.view_count) as sum,COUNT(tags.type) as count'))
                     ->orderBy('sum','desc')
                     ->groupby('type')
                     ->orderBy('count','desc')
                     ->take($num)
                     ->get();
        return $tags;
    }

    public function loadAlltags($picture_id){
        $tags = $this->where('post_id',$picture_id)->get();
        
        return $tags;
    
    }
    
    public function countThisTag($type){

        return $this->where('type',$type)->count();
    }

}
 