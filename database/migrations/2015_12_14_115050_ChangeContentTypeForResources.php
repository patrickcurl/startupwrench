<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeContentTypeForResources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::table('resources', function(Blueprint $table) {

            $table->text('content')->nullable()->after('description')->change();

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resources', function(Blueprint $table) {

            $table->string('content')->nullable()->change();
 
        });
    }
}
