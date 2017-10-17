<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppsTable extends Migration
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
            
            $table->boolean('default_blacklist');
            $table->enum('redirect_override', ['disabled', 'always_redirect', 'never_redirect']);
        });

        app('db')->table('apps')->insert([
            'name' => 'default',
            'default_redirect_url' => "https://google.com"
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apps');
    }
}
