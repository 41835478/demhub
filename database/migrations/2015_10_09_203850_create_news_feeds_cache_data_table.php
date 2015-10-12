<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsFeedsCacheDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement("
        CREATE TABLE `news_feeds_cache_data` (
          `id` TEXT CHARACTER SET utf8 NOT NULL,
          `items` SMALLINT NOT NULL DEFAULT 0,
          `data` BLOB NOT NULL,
          `mtime` INT UNSIGNED NOT NULL,
          UNIQUE (
            `id`(125)
          )
        );
      ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news_feeds_cache_data');
    }
}
