<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoCatCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('geo_cat_currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('symbol')->nullable();
            $table->string('iso3');
            $table->boolean('isActive')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                        'name',
                        'symbol',
                        'iso3',
	                    'isActive'
                    ],'geo_cat_currencies_column_index');
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
