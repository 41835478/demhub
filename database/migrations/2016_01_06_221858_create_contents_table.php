<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subclass');
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('data')->nullable();
            $table->string('divisions')->nullable();
            $table->string('keywords')->nullable();
            $table->string('slug')->nullable();
            $table->string('url')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->float('lat')->nullable();
            $table->float('lng')->nullable();
            $table->integer('pinned_by')->unsigned()->nullable();
            $table->timestamp('pinned_at')->nullable();
            $table->tinyInteger('visibility')->default(1);
            $table->tinyInteger('status_flag')->nullable();
            $table->integer('owner_id')->unsigned()->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamp('publish_date')->nullable();
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
        Schema::drop('contents');
    }
}
