<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveLogosFromResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resources', function($t){
            $t->dropColumn('logo_file_size');
            $t->dropColumn('logo_content_type');
            $t->dropColumn('logo_updated_at');
            $t->dropColumn('logo_url');
            $t->dropColumn('featured_image_filename');
            $t->renameColumn('logo_file_name', 'logo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resources', function($t){
            $t->addColumn('logo_file_size');
            $t->addColumn('logo_content_type');
            $t->addColumn('logo_updated_at');
            $t->addColumn('logo_url');
            $t->addColumn('featured_image_filename');
            $t->renameColumn('logo', 'logo_file_name');
        });
    }
}
