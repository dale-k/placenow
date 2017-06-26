<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use App\Post;
use App\Place;
use App\Votehistory;
use App\Tag;
use Crypt;
use Auth;
use DB;
use Event;
use App\Events\ViewPostHandler;
use Illuminate\Contracts\Encryption\DecryptException;


class pictureController extends Controller{

    public function showPhoto($photoID){
        
        $picture = New Post;
        $picture = $picture->loadOnePicture($photoID);
        $post = $picture;

        Event::fire(new ViewPostHandler($post));

        $pictures_before = new Post;
        $pictures_before = $pictures_before->loadBeforePicture($photoID);

        $pictures_after = new Post;
        $pictures_after = $pictures_after->loadAfterPicture($photoID);

        $ids_before = array();
        $userids_before = array();
        foreach($pictures_before as $before){
            array_push($ids_before,$before->id);
            array_push($userids_before,$before->user_id);

        }
        $ids_after = array();
        $userids_after = array();
        foreach($pictures_after as $after){
            array_push($ids_after,$after->id);
            array_push($userids_after,$after->user_id);

        }
       
        $user_id = $picture->user_id;
        $auth_id = Auth::user()->id;

        $ch_follow = New User;
        $ch_follow = $ch_follow->following($user_id);

        $followlist_before = New User;
        $followlist_before = $followlist_before->chkFollowList($userids_before);

        $followlist_after = new User;
        $followlist_after = $followlist_after -> chkFollowList($userids_after);

        $voteHistory = New Votehistory;
        $voteHistory = $voteHistory->loadVotehistory($auth_id,$photoID);
        $history_before = new Votehistory;
        $history_before = $history_before->loadVotehistoryList($ids_before);
        $history_after = new Votehistory;
        $history_after = $history_after->loadVotehistoryList($ids_after);

        $tags = new Tag;
        $tags = $tags->loadAlltags($picture->id);
        $num_of_photos = 1 +count($pictures_before)+count($pictures_after);


        return view('picture',compact('picture','ch_follow','followlist_before','followlist_after','voteHistory','tags','pictures_before','pictures_after','history_before','history_after','num_of_photos'));


    }

}
