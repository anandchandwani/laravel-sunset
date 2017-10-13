<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Each network request
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ip_id')->unsigned();
            $table->foreign('ip_id')->references('id')->on('ips');
            $table->string('redirected_to')->nullable(); //null = no redirect
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
        Schema::dropIfExists('requests');
    }
}
