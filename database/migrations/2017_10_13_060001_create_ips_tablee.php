<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpsTablee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip')->unique(); //IP address of user
            $table->integer('app_id')->unsigned();
            $table->foreign('app_id')->references('id')->on('apps');
            $table->boolean('is_blacklisted')->nullable(); //null means option hasn't been made yet.
            $table->string('redirect_url'); //only used if blacklisted
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
        Schema::dropIfExists('ips');
    }
}
