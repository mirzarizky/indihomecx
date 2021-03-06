<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('path');
            $table->date('tanggalMulaiPesanan');
            $table->date('tanggalAkhirPesanan');
            $table->integer('totalNoHp')->nullable();
            $table->integer('totalEmail')->nullable();
            $table->bigInteger('totalPesanan')->nullable();
            $table->tinyInteger('berkasStatus')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berkas');
    }
}
