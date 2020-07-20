<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePencapaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pencapaian', function (Blueprint $table) {
            $table->increments('id_pencapaian');
            $table->string('sales_kode', 6)->nullable();
            $table->string('dist_kode', 6)->nullable();
            $table->bigInteger('target')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pencapaian');
    }
}
