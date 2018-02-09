<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = date('Y-m-d H:i:s');
        $peranAdmin = \App\Role::where('name', 'admin')->first();
        $peranSupervisor = \App\Role::where('name', 'supervisor')->first();
        DB::table('users')->insert([
           [
               'nik' => 999999,
               'name' => 'Mirza Rizky',
               'email' => 'mirzarizky@gmail.com',
               'password' => bcrypt('password'),
               'defaultPassword' => false,
               'role_id' => $peranAdmin->id,
               'created_at'=> $currentDate,
               'updated_at'=>$currentDate
           ],
           [
               'nik' => 999888,
               'name' => 'Dyah Ayu',
               'email' => 'dyahanndta@gmail.com',
               'password' => bcrypt('password'),
               'defaultPassword' => false,
               'role_id' => $peranSupervisor->id,
               'created_at'=> $currentDate,
               'updated_at'=>$currentDate
           ]
        ]);
    }
}
