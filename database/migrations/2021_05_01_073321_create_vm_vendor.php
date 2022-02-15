<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVmVendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vm_vendor', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('company_name',100)->nullable()->default("");
            $table->text('address')->nullable();
            $table->string('contact_email',80)->nullable()->default("");
            $table->string('contact_mobile',15)->nullable()->default("");
            $table->string('contact_office',15)->nullable()->default("");
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
        Schema::dropIfExists('vm_vendor');
    }
}
