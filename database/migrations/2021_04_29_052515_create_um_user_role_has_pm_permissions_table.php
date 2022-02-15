<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmUserRoleHasPmPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('um_user_role_has_pm_permissions', function (Blueprint $table) {
            $table->integer('pm_permissions_id');
            $table->integer('um_user_role_id');
            $table->primary(['pm_permissions_id', 'um_user_role_id'],"user_role_permission_id");
            $table->foreign('pm_permissions_id')->references('id')->on('pm_permissions');
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
        Schema::dropIfExists('um_user_role_has_pm_permissions');
    }
}
