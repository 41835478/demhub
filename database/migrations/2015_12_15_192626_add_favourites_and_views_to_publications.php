<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFavouritesAndViewsToPublications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('publications', function(Blueprint $table) {
        $table->integer('favorites')->nullable();
        $table->integer('views')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('publications', function(Blueprint $table) {
        $table->dropColumn('favorites');
        $table->dropColumn('views');
      });
    }
}
