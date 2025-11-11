<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['supplier_id' => 1, 'supplier_kode' => 'SUP01', 'supplier_nama' => 'PT. Sumber Rezeki Bersama', 'supplier_alamat' => 'Jl. Kenanga No. 12, Surabaya'],
            ['supplier_id' => 2, 'supplier_kode' => 'SUP02', 'supplier_nama' => 'CV. Makmur Sentosa', 'supplier_alamat' => 'Jl. Melati No. 88, Sidoarjo'],
            ['supplier_id' => 3, 'supplier_kode' => 'SUP03', 'supplier_nama' => 'UD. Berkah Niaga', 'supplier_alamat' => 'Jl. Mawar No. 7, Gresik'],
        ];

        DB::table('m_supplier')->insert($data);
    }
}
