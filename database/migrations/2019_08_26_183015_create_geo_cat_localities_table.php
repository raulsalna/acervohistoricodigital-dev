<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoCatLocalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_cat_localities', function (Blueprint $table) {

            $table->bigIncrements('id');
	        $table->string('name');
	        $table->char('postalCode', 10)->nullable();
	        $table->double('latitude')->nullable();
	        $table->double('longitude')->nullable();
	        $table->unsignedBigInteger('geo_cat_state_id');
	        $table->boolean('isActive')->default(1);
	        $table->timestamps();
	        $table->softDeletes();


	        $table->foreign('geo_cat_state_id')
		        ->references('id')
		        ->on('geo_cat_states');

	        $table->index([
		        'name',
		        'postalCode',
		        'latitude',
		        'longitude',
		        'geo_cat_state_id',
		        'isActive'
	        ],'geo_cat_localities_column_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_cat_localities');
    }
}
