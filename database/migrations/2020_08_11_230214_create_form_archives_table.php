<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_archives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('title',256);// quieren que sea duplicado
            $table->unsignedInteger('box_id');
            $table->unsignedInteger('proceedings_id');
            $table->string('placement');
            $table->unsignedInteger('group_id');
            $table->string('year');
            $table->date('openingDate')->nullable();
            $table->date('closingDate')->nullable();
            $table->string('startVolume');
            $table->string('endVolume');
            $table->unsignedInteger('characters_id');
            $table->unsignedInteger('documentaryTradition_id');
            $table->longtext('description',3000);
            $table->longtext('appendNotes',3000)->nullable();
            $table->string('notesArchivist',3000)->nullable();


            $table->softDeletes();
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
        Schema::dropIfExists('form_archives');
    }
}
