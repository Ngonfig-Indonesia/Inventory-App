<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaftarBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang_masuks')->insert([
        	'daftar_id' => 2,
        	'qty' => 20,
        	'tanggal_masuk' => date_create(),
            'tanggal_exp' => date_create(12-10-2023),
            'supplier' => 'Sumber Mas'
        ]);
    }
}
