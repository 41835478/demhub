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
			$table->integer('division');
			$table->integer('source_id', false, true);
			$table->string('source_url');
			$table->string('title');
			$table->string('excerpt');
			$table->string('keywords');
			$table->string('city');
			$table->string('state');
			$table->string('country');
			$table->double('lat');
			$table->double('lng');
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
