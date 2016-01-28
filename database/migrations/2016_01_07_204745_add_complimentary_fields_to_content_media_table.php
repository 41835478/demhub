<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddComplimentaryFieldsToContentMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_media', function (Blueprint $table) {
            $table->string('description')->nullable();
            $table->integer('view_order')->default(0);
            $table->boolean('deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_media', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('view_order');
            $table->dropColumn('deleted');
        });
    }
}
