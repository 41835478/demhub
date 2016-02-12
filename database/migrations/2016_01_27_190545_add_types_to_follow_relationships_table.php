<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypesToFollowRelationshipsTable extends Migration
{
    // Follower and followed types
    // Including connections, bookmarks, tracking, etc.
    const ARTICLE       = 'A';
	const DIVISION      = 'D';
	const KEYWORD       = 'K';
	const LOCATION      = 'L';
	// const ORGANIZATION  = 'O'; // NOTE - Not yet in use
	const PUBLICATION   = 'P';
	const RESOURCE 		= 'R';
	const SCRAPE_SOURCE = 'S';
	const THREAD        = 'T';
	const USER          = 'U';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('follow_relationships', function (Blueprint $table) {
            $table->increments('id')->first();
            $table->index('id');
            $table->char('follower_type', 1)->after('follower_id')->default(self::USER);
            $table->char('followed_type', 1)->after('followed_id')->default(self::USER);
            $table->dropForeign('follow_relationships_follower_id_foreign');
            $table->dropForeign('follow_relationships_followed_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('follow_relationships', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropColumn('follower_type');
            $table->dropColumn('followed_type');
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('followed_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
