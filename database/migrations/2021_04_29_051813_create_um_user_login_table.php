<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmUserLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('um_user_login', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('username',100);
            $table->string('password',100);
            $table->bigInteger('um_user_id');
            $table->foreign('um_user_id')->references('id')->on('um_user');
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
        Schema::dropIfExists('um_user_login');
    }
}
