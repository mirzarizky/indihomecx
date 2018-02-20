<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = date('Y-m-d H:i:s');
        DB::table('status')->insert([
            [
                'kode' => 'PS',
                'nama' => 'completed',
                'created_at'=> $currentDate,
                'updated_at'=> $currentDate
            ]
        ]);
    }
}
