<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormArchivesProducersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_archives_producers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('form_archives_id')->unsigned()->nullable();
            $table->bigInteger('cat_producer_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('form_archives_id')->references('id')->on('form_archives')->onDelete('cascade');
            $table->foreign('cat_producer_id')->references('id')->on('cat_producer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_archives_producers');
    }
}
