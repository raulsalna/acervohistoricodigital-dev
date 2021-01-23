<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormArchivesLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_archives_languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('form_archives_id')->unsigned()->nullable();
            $table->bigInteger('geo_cat_idioms_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('form_archives_id')->references('id')->on('form_archives')->onDelete('cascade');
            $table->foreign('geo_cat_idioms_id')->references('id')->on('geo_cat_idioms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_archives_languages');
    }
}
