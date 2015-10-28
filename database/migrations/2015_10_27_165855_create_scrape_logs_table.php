<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScrapeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('scrape_logs', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('source_id');
			$table->boolean('automated');
			$table->string('url');
			$table->integer('saved_count');
			$table->timestamp('last_item');
			$table->text('data');
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
		Schema::drop('scrape_logs');
    }
}
