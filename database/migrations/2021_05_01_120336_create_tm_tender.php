<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmTender extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_tender', function (Blueprint $table) {
            $table->string('id',100)->primary();
            $table->string('title',100);
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');

            $table->integer('tm_tender_status_id');
            $table->foreign('tm_tender_status_id')->references('id')->on('tm_tender_status');

            $table->bigInteger('crby');
            $table->foreign('crby')->references('id')->on('um_user');

            $table->double('deposit', 8, 2)->default(0);
            $table->double('estimate_cost', 8, 2)->default(0);

            $table->string('location',100);

            $table->string('attachment_path',100)->default("");

            $table->bigInteger('tm_tender_category_id');
            $table->foreign('tm_tender_category_id')->references('id')->on('tm_tender_category');

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
        Schema::dropIfExists('tm_tender');
    }
}
