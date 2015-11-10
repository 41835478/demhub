<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArticleTypeToScrapeSources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('scrape_sources', function(Blueprint $table) {

			$table->integer('article_type')->nullable()->after('type');

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('scrape_sources', function(Blueprint $table) {

			$table->dropColumn('article_type');

		});
    }
}
