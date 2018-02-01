<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survei', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nilai');
            $table->string('komentar')->nullable();
            $table->bigInteger('pesanan_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('survei', function (Blueprint $table) {
            $table->foreign('pesanan_id')->references('id')->on('pesanan');
        });

        Schema::table('detail_kriteria', function (Blueprint $table) {
            $table->foreign('kriteria_id')->references('id')->on('kriteria');
            $table->foreign('survei_id')->references('id')->on('survei');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survei');
    }
}
