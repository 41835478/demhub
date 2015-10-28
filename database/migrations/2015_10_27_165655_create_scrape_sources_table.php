<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScrapeSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('scrape_sources', function (Blueprint $table) {
			$table->increments('id');
			$table->string('type', 32);
			$table->string('title');
			$table->string('url');
			$table->integer('division_id');
			$table->timestamp('last_checked_item');
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
		Schema::drop('scrape_sources');
    }
}
