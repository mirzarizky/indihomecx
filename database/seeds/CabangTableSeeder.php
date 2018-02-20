<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = date('Y-m-d H:i:s');
        DB::table('cabang')->insert([
            ['kode' => 'DEP', 'nama' => 'depok', 'created_at' => $currentDate, 'updated_at' => $currentDate],
            ['kode' => 'SKJ', 'nama' => 'sukmajaya', 'created_at' => $currentDate, 'updated_at' => $currentDate],
            ['kode' => 'PRM', 'nama' => 'pancoran mas', 'created_at' => $currentDate, 'updated_at' => $currentDate],
            ['kode' => 'CSL', 'nama' => 'cisalak', 'created_at' => $currentDate, 'updated_at' => $currentDate],
            ['kode' => 'CNE', 'nama' => 'cinere', 'created_at' => $currentDate, 'updated_at' => $currentDate]
        ]);
    }
}
