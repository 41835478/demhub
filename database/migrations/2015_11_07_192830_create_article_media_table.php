<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('article_medias', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('article_id', false, true);
			$table->string('filename')->nullable();
			$table->string('filetype', 32)->nullable();
			$table->integer('view_order')->nullable();
			$table->boolean('deleted')->default(0);
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
		Schema::drop('article_medias');
    }
}
