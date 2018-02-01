<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCabangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->string('nama');
            $table->timestamps();
        });

        $currentDate = date('Y-m-d H:i:s');
        $cabangDepok =[
            ['kode' => 'dep', 'nama' => 'depok', 'created_at' => $currentDate, 'updated_at' => $currentDate],
            ['kode' => 'skj', 'nama' => 'sukmajaya', 'created_at' => $currentDate, 'updated_at' => $currentDate],
            ['kode' => 'prm', 'nama' => 'pancoran mas', 'created_at' => $currentDate, 'updated_at' => $currentDate],
            ['kode' => 'csl', 'nama' => 'cisalak', 'created_at' => $currentDate, 'updated_at' => $currentDate],
            ['kode' => 'cne', 'nama' => 'cinere', 'created_at' => $currentDate, 'updated_at' => $currentDate]
        ];
        \App\Cabang::insert($cabangDepok);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cabangs');
    }
}
