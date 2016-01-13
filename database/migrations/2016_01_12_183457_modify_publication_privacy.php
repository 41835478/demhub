<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPublicationPrivacy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('publications', function(Blueprint $table) {
        $table->renameColumn('privacy', 'visibility');
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
        $table->renameColumn('visibility', 'privacy');
      });

    }
}
