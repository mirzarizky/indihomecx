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
            ['kode' => 'dep', 'nama' => 'depok', 'created_at' => $currentDate, 'updated_at' => $currentDate],
            ['kode' => 'skj', 'nama' => 'sukmajaya', 'created_at' => $currentDate, 'updated_at' => $currentDate],
            ['kode' => 'prm', 'nama' => 'pancoran mas', 'created_at' => $currentDate, 'updated_at' => $currentDate],
            ['kode' => 'csl', 'nama' => 'cisalak', 'created_at' => $currentDate, 'updated_at' => $currentDate],
            ['kode' => 'cne', 'nama' => 'cinere', 'created_at' => $currentDate, 'updated_at' => $currentDate]
        ]);
    }
}
