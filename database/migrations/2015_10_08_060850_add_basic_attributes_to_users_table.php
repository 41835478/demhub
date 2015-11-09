<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBasicAttributesToUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::table('users', function (Blueprint $table) {
          $table->renameColumn('name', 'first_name');
          $table->string('last_name');
          $table->string('job_title');
          $table->string('organization_name');
          $table->string('phone_number', 22);
          $table->string('division');
          $table->string('specialization');
          $table->string('location');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::table('users', function (Blueprint $table) {
          $table->renameColumn('first_name', 'name');
          $table->dropColumn([
            'last_name',
            'job_title',
            'organization_name',
            'phone_number',
            'division',
            'specialization',
            'location',
          ]);
      });
  }
}
