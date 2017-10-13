<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Each app, allows for multiple proxying rules.
        Schema::create('apps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); //IP address of user
            $table->string('default_redirect_url');
            $table->timestamps();
        });

        //Each unique IP
        Schema::create('ips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip'); //IP address of user
            $table->integer('app_id')->unsigned();
            $table->foreign('app_id')->references('id')->on('apps');
            $table->boolean('is_blacklisted');
            $table->string('redirect_url'); //only used if blacklisted
            $table->timestamps();
        });

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
        Schema::dropIfExists('apps');
        Schema::dropIfExists('ips');
        Schema::dropIfExists('requests');
    }
}
