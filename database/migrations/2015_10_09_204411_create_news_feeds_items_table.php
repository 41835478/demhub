<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsFeedsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement("
        CREATE TABLE `items` (
          `feed_id` TEXT CHARACTER SET utf8 NOT NULL,
          `id` TEXT CHARACTER SET utf8 NOT NULL,
          `data` TEXT CHARACTER SET utf8 NOT NULL,
          `posted` INT UNSIGNED NOT NULL,
          INDEX `feed_id` (
            `feed_id`(125)
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
