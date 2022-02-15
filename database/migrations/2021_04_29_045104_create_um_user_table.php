<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('um_user', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('firstname',100);
            $table->string('lastname',100)->nullable()->default("");
            $table->integer('um_user_status_id');
            $table->integer('um_user_role_id');
            $table->foreign('um_user_status_id')->references('id')->on('um_user_status');
            $table->foreign('um_user_role_id')->references('id')->on('um_user_role');
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
        Schema::dropIfExists('um_user');
    }
}
