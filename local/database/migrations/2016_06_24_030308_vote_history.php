<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VoteHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('votehistories',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('picture_id');
            $table->boolean('voted');
            $table->boolean('favored');
            $table->boolean('recommended');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::drop('votehistories');
    }
}
