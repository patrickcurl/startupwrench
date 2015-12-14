<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClicksToResources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::table('resources', function(Blueprint $table) {

            $table->string('afflink')->nullable()->after('domain');
            $table->integer('clicks')->nullable()->before('afflink')->default(0);

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

            $table->dropColumn('afflink');
            $table->dropColumn('clicks');
 
        });
    }
}
