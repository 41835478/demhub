<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDocumentFieldsToPublicationsTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publications', function(Blueprint $table) {

            $table->string('document_file_name')->nullable();
            $table->integer('document_file_size')->nullable()->after('document_file_name');
            $table->string('document_content_type')->nullable()->after('document_file_size');
            $table->timestamp('document_updated_at')->nullable()->after('document_content_type');

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publications', function(Blueprint $table) {

            $table->dropColumn('document_file_name');
            $table->dropColumn('document_file_size');
            $table->dropColumn('document_content_type');
            $table->dropColumn('document_updated_at');

        });
    }

}
