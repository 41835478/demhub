<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('keywords', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('weight')->nullable();
			$table->string('keyword');
			$table->string('slug');
			$table->string('divisions')->nullable();
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
		Schema::drop('keywords');
    }
}
