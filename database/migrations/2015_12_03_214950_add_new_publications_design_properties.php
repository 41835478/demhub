<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewPublicationsDesignProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('publications', function(Blueprint $table) {

        $table->string('privacy')->nullable();
        $table->string('divisions')->nullable();

        $table->string('keywords')->nullable();

        $table->integer('volume')->nullable()->after('keywords');
        $table->string('issues')->nullable()->after('volume');
        $table->integer('pages')->nullable()->after('issues');
        $table->string('publisher')->nullable()->after('pages');
        $table->string('institution')->nullable()->after('publisher');
        $table->string('conference')->nullable()->after('institution');


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

          $table->dropColumn('privacy');
          $table->dropColumn('divisions');

          $table->dropColumn('keywords');

          $table->dropColumn('volume');
          $table->dropColumn('issues');
          $table->dropColumn('pages');
          $table->dropColumn('publisher');
          $table->dropColumn('institution');
          $table->dropColumn('conference');
      });
    }
}
