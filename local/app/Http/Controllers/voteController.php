<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\VoteHistory;
use Auth;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class voteController extends Controller
{
	 public function showVote(Request $request){
    	$picture = $this->findVote($request->picture_id);
    	return $picture;
    }

     public function showVoteHistory(Request $request){
     	$votehistory = $this->findUservote($request->picture_id);
     	return $votehistory;
     }

	public function selePicutre(Request $request){
		// $request  contain 3 options  , vote => 0 / favor => 1 / recommend => 2
        //             and   2 selection , select => 1 / diselect => 0
		$options = $request->options;
		$select =  $request->select;

        $pictureID = $request->value;
        try {
            $pictureID = Crypt::decrypt($pictureID);
        } catch (DecryptException $e) {
            //
        }
		$picture = $this->findVote($pictureID);
		$votehistory = $this->findUservote($pictureID);

		if($options==0){
			// user clicked voted
			if($select==1){
				// add voted count , change user vote history ( false to true)
				$this->addVote( $picture , $votehistory);
			}else{
				// decrease voted count , change user vote history ( true to false)
				$this->unVote($picture,$votehistory);
			}
		}else if ($options == 1){
			if($select==1){
				$this->addFavor($picture,$votehistory);
			}else{
				$this->unFavor($picture,$votehistory);
			}
		}else
			if($select==1){
				$this->addRecommend($picture,$votehistory);
			}else{
				$this->unRecommend($picture,$votehistory);
			}

            return back();
 	}

    public function findVote($picture_id){
    	$rate = Post::where('id',$picture_id)->first();
    	return $rate;
    }
    public function findUservote($picture_id){
    	$user_id = Auth::user()->id;
    	$votehistory = Votehistory::where([
    		['picture_id',$picture_id],
    		['user_id',$user_id],
    		])->first();
    	
    	if($votehistory== null){
    		$votehistory = New Votehistory;
    		$votehistory-> user_id = $user_id;
    		$votehistory-> picture_id = $picture_id;
    		$votehistory->voted = false;
    		$votehistory->favored = false;
    		$votehistory->recommended = false;
    		$votehistory->save();
    	}

    	return $votehistory;
    }

    private function addVote(Post $picture ,Votehistory $votehistory){
    	$picture->vote_count += 1;
    	$votehistory->voted = true;
    	$picture->save();
		$votehistory->save();
    }
    private function unVote(Post $picture , Votehistory $votehistory){
    	$picture->vote_count -=1;
		$votehistory->voted = false;
		$picture->save();
		$votehistory->save();
    }
    private function addFavor(Post $picture , Votehistory $votehistory){
    	$picture->favor_count +=1;
		$votehistory->favored = true;
		$picture->save();
		$votehistory->save();
    }
    private function unFavor(Post $picture , Votehistory $votehistory){
    	$picture->favor_count -=1;
		$votehistory->favored = false;
		$picture->save();
		$votehistory->save();
    }
    private function addRecommend(Post $picture , Votehistory $votehistory){
    	$picture->recommend_count +=1;
		$votehistory->recommended = true;
		$picture->save();
		$votehistory->save();
    }
    private function unRecommend(Post $picture , Votehistory $votehistory){
		$picture->recommend_count -=1;
		$votehistory->recommended = false;
		$picture->save();
		$votehistory->save();
    }

   
}
