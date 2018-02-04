<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // inisiasi awal role admin & supervisor
        $currentDate = date('Y-m-d H:i:s');
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'created_at'=> $currentDate,
                'updated_at'=>$currentDate
            ],
            [
                'name' => 'supervisor',
                'created_at'=> $currentDate,
                'updated_at'=> $currentDate
            ]
        ]);
    }
}
