<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        // inisiasi awal role admin & supervisor
        $currentDate = date('Y-m-d H:i:s');
        $initialPeran = array(
            array('name' => 'admin', 'created_at'=> $currentDate, 'updated_at'=>$currentDate),
            array('name' => 'supervisor', 'created_at'=> $currentDate, 'updated_at'=> $currentDate)
        );
        \App\Role::insert($initialPeran);

        // membuat column role_id di table users sebagai foreign key
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->after('password');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        // inisialiasi awal admin & spv
        $peranAdmin = \App\Role::where('name', 'admin')->first();
        $peranSupervisor = \App\Role::where('name', 'supervisor')->first();
        $initialUser = array(
            array(
                'nik' => 999999,
                'name' => 'Mirza Rizky',
                'email' => 'mirzarizky@gmail.com',
                'password' => bcrypt('password'),
                'role_id' => $peranAdmin->id,
                'created_at'=> $currentDate,
                'updated_at'=>$currentDate
            ),
            array(
                'nik' => 999888,
                'name' => 'Dyah Ayu',
                'email' => 'dyahanndta@gmail.com',
                'password' => bcrypt('password'),
                'role_id' => $peranSupervisor->id,
                'created_at'=> $currentDate,
                'updated_at'=>$currentDate
            )
        );
        \App\User::insert($initialUser);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
