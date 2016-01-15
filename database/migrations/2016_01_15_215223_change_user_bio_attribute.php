<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUserBioAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		  DB::statement('ALTER TABLE users MODIFY COLUMN bio TEXT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement('ALTER TABLE users MODIFY COLUMN bio VARCHAR(255)');
    }
}
