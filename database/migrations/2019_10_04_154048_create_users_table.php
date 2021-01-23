<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->unsignedBigInteger('cat_profile_id');
            $table->unsignedBigInteger('cat_transaction_id')->nullable();
            $table->string('name');
            $table->string('firstName');
            $table->string('secondName')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cat_profile_id')->references('id')->on('cat_profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
