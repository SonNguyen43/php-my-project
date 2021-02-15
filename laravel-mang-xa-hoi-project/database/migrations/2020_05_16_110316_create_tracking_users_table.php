<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('action',191);
            $table->string('content',1991)->nullable();
            $table->integer('user_id');
            $table->integer('post_id')->nullable();
            $table->string('device',191);
            $table->string('ip_address',191);
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
        Schema::dropIfExists('tracking_users');
    }
}
