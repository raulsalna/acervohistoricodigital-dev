<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoCatStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_cat_states', function (Blueprint $table) {
            $table->bigIncrements('id');
	        $table->string('name');
	        $table->char('acronym', 5)->nullable();
	        $table->double('latitude')->nullable();
	        $table->double('longitude')->nullable();
	        $table->unsignedBigInteger('geo_cat_country_id');
	        $table->boolean('isActive')->default(1);
	        $table->timestamps();
	        $table->softDeletes();

	        $table->foreign('geo_cat_country_id')
		        ->references('id')
		        ->on('geo_cat_countries');

	        $table->index([
		        'name',
		        'acronym',
		        'latitude',
		        'longitude',
		        'isActive',
		        'geo_cat_country_id'
	        ],'geo_cat_states_column_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_cat_states');
    }
}
