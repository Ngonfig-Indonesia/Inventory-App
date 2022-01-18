<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class DaftarItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 5000; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('daftar_items')->insert([
    			'kode_barang' => $faker->jobTitle,
                'barcode' => $faker->phoneNumber,
    			'nama_barang' => $faker->name,
    		]);
 
    	}
 
    }
}
