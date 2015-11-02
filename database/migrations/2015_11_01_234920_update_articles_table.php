<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('articles', function (Blueprint $table) {
			$table->integer('source_id', false, true)->nullable()->change();
			$table->string('source_url')->nullable()->change();
		});
		DB::statement('ALTER TABLE `articles` MODIFY `publish_date` DATETIME NULL DEFAULT null;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
			$table->integer('source_id', false, true)->change();
			$table->string('source_url')->change();
		});
		DB::statement('ALTER TABLE `articles` MODIFY `publish_date` DATETIME;');
    }
}
