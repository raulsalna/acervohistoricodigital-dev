<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoCatCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_cat_countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('nationalityMale')->nullable();
            $table->string('nationalityFamale')->nullable();
            $table->char('iso2', 2)->nullable();
            $table->char('iso3', 3)->nullable();
            $table->bigInteger('geo_cat_idiom_id')->unsigned()->nullable();
            $table->bigInteger('geo_cat_continent_id')->unsigned()->nullable();
            $table->bigInteger('geo_cat_region_id')->unsigned()->nullable();
            $table->boolean('isActive')->default(1);
            $table->bigInteger('order')->nullable();
            $table->string('code_number')->nullable();
            $table->timestamps();
            $table->softDeletes();



            $table->foreign('geo_cat_idiom_id')
                  ->references('id')
                  ->on('geo_cat_idioms');

            $table->foreign('geo_cat_continent_id')
                  ->references('id')
                  ->on('geo_cat_continents');

            $table->foreign('geo_cat_region_id')
                  ->references('id')
                  ->on('geo_cat_regions');

            $table->index([
                        'name',
                        'nationalityMale',
                        'nationalityFamale',
                        'iso2',
                        'iso3',
	                    'isActive'
                    ],'geo_cat_countries_column_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
