<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('articles', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('type');
			$table->string('divisions')->nullable();
			$table->integer('source_id', false, true);
			$table->string('source_url');
			$table->string('title');
			$table->string('excerpt');
			$table->string('keywords')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('country')->nullable();
			$table->double('lat')->nullable();
			$table->double('lng')->nullable();
			$table->integer('review');
			$table->boolean('deleted');
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
		Schema::drop('articles');
    }
}
