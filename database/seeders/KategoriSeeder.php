<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'kategori_kode' => 'SNC', 'kategori_nama' => 'Snack'],
            ['kategori_id' => 2, 'kategori_kode' => 'BHN', 'kategori_nama' => 'Bahan Dapur'],
            ['kategori_id' => 3, 'kategori_kode' => 'KCS', 'kategori_nama' => 'Kecantikan'],
            ['kategori_id' => 4, 'kategori_kode' => 'HDL', 'kategori_nama' => 'Peralatan Handphone'],
            ['kategori_id' => 5, 'kategori_kode' => 'FAS', 'kategori_nama' => 'Fashion'],
        ];

        DB::table('m_kategori')->insert($data);
    }
}
