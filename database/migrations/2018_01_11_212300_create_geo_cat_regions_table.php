<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoCatRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_cat_regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('geo_cat_continent_id')->unsigned();
            $table->timestamps();
            $table->boolean('isActive')->default(1);
            $table->softDeletes();

            $table->foreign('geo_cat_continent_id')
                  ->references('id')
                  ->on('geo_cat_continents');

            $table->index([
                        'name',
	                    'geo_cat_continent_id'
                    ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
