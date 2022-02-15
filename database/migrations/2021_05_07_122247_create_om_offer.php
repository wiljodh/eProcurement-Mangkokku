<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOmOffer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('om_offer', function (Blueprint $table) {
            $table->string('id',100)->primary();
            $table->double('bid_amount', 8, 2)->default(0);

            $table->string('period',60)->default(''); // 1 Year and 2 Months

            $table->integer('om_offer_status_id');
            $table->foreign('om_offer_status_id')->references('id')->on('om_offer_status');

            $table->bigInteger('vm_vendor_id');
            $table->foreign('vm_vendor_id')->references('id')->on('vm_vendor');

            $table->string('tm_tender_id',100);
            $table->foreign('tm_tender_id')->references('id')->on('tm_tender');

            $table->text('note')->nullable();
        
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
        Schema::dropIfExists('om_offer');
    }
}
