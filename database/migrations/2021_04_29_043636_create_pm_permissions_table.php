<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pm_permissions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('permission',100);
            $table->string('tab_name',100);
            $table->string('url_path',100);
            $table->tinyInteger('is_tab')->default('0');
            $table->integer('order_no')->default(0);
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
        Schema::dropIfExists('pm_permissions');
    }
}
