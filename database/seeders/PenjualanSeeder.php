<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $date = $now->copy()->subDays(5);

        $data = [
            ['penjualan_id' => 1, 'user_id' => 2, 'pembeli' => 'Rizky',     'penjualan_kode' => 'PNJ101', 'penjualan_tanggal' => $date->copy()->addDays(4)],
            ['penjualan_id' => 2, 'user_id' => 2, 'pembeli' => 'Satria',    'penjualan_kode' => 'PNJ102', 'penjualan_tanggal' => $date->copy()->addDays(4)],
            ['penjualan_id' => 3, 'user_id' => 2, 'pembeli' => 'Lukman',    'penjualan_kode' => 'PNJ103', 'penjualan_tanggal' => $date->copy()->addDays(3)],
            ['penjualan_id' => 4, 'user_id' => 2, 'pembeli' => 'Irfan',     'penjualan_kode' => 'PNJ104', 'penjualan_tanggal' => $date->copy()->addDays(3)],
            ['penjualan_id' => 5, 'user_id' => 2, 'pembeli' => 'Aulia',     'penjualan_kode' => 'PNJ105', 'penjualan_tanggal' => $date->copy()->addDays(2)],
            ['penjualan_id' => 6, 'user_id' => 2, 'pembeli' => 'Farhan',    'penjualan_kode' => 'PNJ106', 'penjualan_tanggal' => $date->copy()->addDays(2)],
            ['penjualan_id' => 7, 'user_id' => 2, 'pembeli' => 'Hendra',    'penjualan_kode' => 'PNJ107', 'penjualan_tanggal' => $date->copy()->addDays(1)],
            ['penjualan_id' => 8, 'user_id' => 2, 'pembeli' => 'Yoga',      'penjualan_kode' => 'PNJ108', 'penjualan_tanggal' => $date->copy()->addDays(1)],
            ['penjualan_id' => 9, 'user_id' => 2, 'pembeli' => 'Dimas',     'penjualan_kode' => 'PNJ109', 'penjualan_tanggal' => $date->copy()],
            ['penjualan_id' => 10,'user_id' => 2, 'pembeli' => 'Andika',    'penjualan_kode' => 'PNJ110', 'penjualan_tanggal' => $date->copy()],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
