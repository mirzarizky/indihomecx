<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('path');
            $table->timestamps();
        });

        // membuat column avatar_id di table users sebagai foreign key
        Schema::table('users', function (Blueprint $table) {
            $table->integer('avatar_id')->unsigned()->after('defaultPassword')->nullable();
            $table->foreign('avatar_id')->references('id')->on('avatars')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avatars');
    }
}
