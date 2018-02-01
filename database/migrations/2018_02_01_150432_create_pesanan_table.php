<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tanggal');
            $table->string('namaPelanggan');
            $table->integer('noHpPelanggan')->nullable();
            $table->string('emailPelanggan')->nullable();
            $table->string('status_kode');
            $table->string('cabang_kode');
            $table->boolean('isSurvei')->default(false);
            $table->integer('berkas_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('pesanan', function (Blueprint $table) {
            $table->foreign('status_kode')->references('kode')->on('status');
            $table->foreign('cabang_kode')->references('kode')->on('cabang');
            $table->foreign('berkas_id')->references('id')->on('berkas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
