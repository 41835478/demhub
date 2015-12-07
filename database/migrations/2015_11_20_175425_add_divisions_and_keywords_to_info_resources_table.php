<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDivisionsAndKeywordsToInfoResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('info_resources', function (Blueprint $table) {
            // $table->string('divisions');
            // $table->string('keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('info_resources', function (Blueprint $table) {
            $table->dropColumn('divisions');
            $table->dropColumn('keywords');
        });
    }
}
