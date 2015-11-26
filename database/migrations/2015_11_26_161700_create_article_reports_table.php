<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('article_reports', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('article_id');
			$table->integer('user_id')->nullable();
			$table->string('reason', 64)->nullable();
			$table->string('result')->nullable();
			$table->text('data')->nullable();

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
		Schema::drop('article_reports');
    }
}
