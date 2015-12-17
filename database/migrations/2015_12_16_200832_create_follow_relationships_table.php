<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_relationships', function (Blueprint $table) {
            $table->integer('follower_id')->unsigned()->index();
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('followed_id')->unsigned();
            $table->foreign('followed_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('follow_relationships');
    }
}
