<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('representation');
            $table->text('description');
            $table->string('content');
            $table->string('domain');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('slug')->unique();
            $table->string('featured_image');
            $table->string('featured_image_filename')->nullable();
            $table->timestamp('featured_image_updated_at')->nullable();
            $table->string('logo_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('resources');
    }
}
