<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageDescriptionToArticleMedias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('article_medias', function(Blueprint $table) {

			$table->integer('description')->nullable()->after('filetype');

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('article_medias', function(Blueprint $table) {

			$table->dropColumn('description');

		});
    }
}
