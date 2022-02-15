
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmTenderCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_tender_category', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name',100);
            $table->string('symble',5)->default('');
            $table->tinyInteger('active')->default('1');
            $table->string('icon',45)->default('fa fa-linode');
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
        Schema::dropIfExists('tm_tender_category');
    }
}
