<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // --- Penjualan ID 1 ---
            ['detail_id' => 1, 'penjualan_id' => 1, 'barang_id' => 2, 'harga' => 9500, 'jumlah' => 2],
            ['detail_id' => 2, 'penjualan_id' => 1, 'barang_id' => 6, 'harga' => 11000, 'jumlah' => 1],
            ['detail_id' => 3, 'penjualan_id' => 1, 'barang_id' => 13, 'harga' => 21000, 'jumlah' => 1],

            // --- Penjualan ID 2 ---
            ['detail_id' => 4, 'penjualan_id' => 2, 'barang_id' => 3, 'harga' => 21000, 'jumlah' => 1],
            ['detail_id' => 5, 'penjualan_id' => 2, 'barang_id' => 11, 'harga' => 18000, 'jumlah' => 2],
            ['detail_id' => 6, 'penjualan_id' => 2, 'barang_id' => 9, 'harga' => 5000, 'jumlah' => 3],

            // --- Penjualan ID 3 ---
            ['detail_id' => 7, 'penjualan_id' => 3, 'barang_id' => 1, 'harga' => 12000, 'jumlah' => 2],
            ['detail_id' => 8, 'penjualan_id' => 3, 'barang_id' => 4, 'harga' => 7500, 'jumlah' => 2],
            ['detail_id' => 9, 'penjualan_id' => 3, 'barang_id' => 15, 'harga' => 85000, 'jumlah' => 1],

            // --- Penjualan ID 4 ---
            ['detail_id' => 10, 'penjualan_id' => 4, 'barang_id' => 7, 'harga' => 5000, 'jumlah' => 4],
            ['detail_id' => 11, 'penjualan_id' => 4, 'barang_id' => 12, 'harga' => 8500, 'jumlah' => 2],
            ['detail_id' => 12, 'penjualan_id' => 4, 'barang_id' => 14, 'harga' => 48000, 'jumlah' => 1],

            // --- Penjualan ID 5 ---
            ['detail_id' => 13, 'penjualan_id' => 5, 'barang_id' => 5, 'harga' => 23000, 'jumlah' => 1],
            ['detail_id' => 14, 'penjualan_id' => 5, 'barang_id' => 8, 'harga' => 15000, 'jumlah' => 1],
            ['detail_id' => 15, 'penjualan_id' => 5, 'barang_id' => 10, 'harga' => 35000, 'jumlah' => 1],

            // --- Penjualan ID 6 ---
            ['detail_id' => 16, 'penjualan_id' => 6, 'barang_id' => 2, 'harga' => 9500, 'jumlah' => 3],
            ['detail_id' => 17, 'penjualan_id' => 6, 'barang_id' => 6, 'harga' => 11000, 'jumlah' => 2],
            ['detail_id' => 18, 'penjualan_id' => 6, 'barang_id' => 8, 'harga' => 15000, 'jumlah' => 1],

            // --- Penjualan ID 7 ---
            ['detail_id' => 19, 'penjualan_id' => 7, 'barang_id' => 3, 'harga' => 21000, 'jumlah' => 1],
            ['detail_id' => 20, 'penjualan_id' => 7, 'barang_id' => 9, 'harga' => 5000, 'jumlah' => 2],
            ['detail_id' => 21, 'penjualan_id' => 7, 'barang_id' => 11, 'harga' => 18000, 'jumlah' => 1],

            // --- Penjualan ID 8 ---
            ['detail_id' => 22, 'penjualan_id' => 8, 'barang_id' => 1, 'harga' => 12000, 'jumlah' => 4],
            ['detail_id' => 23, 'penjualan_id' => 8, 'barang_id' => 7, 'harga' => 5000, 'jumlah' => 2],
            ['detail_id' => 24, 'penjualan_id' => 8, 'barang_id' => 14, 'harga' => 48000, 'jumlah' => 1],

            // --- Penjualan ID 9 ---
            ['detail_id' => 25, 'penjualan_id' => 9, 'barang_id' => 6, 'harga' => 11000, 'jumlah' => 1],
            ['detail_id' => 26, 'penjualan_id' => 9, 'barang_id' => 5, 'harga' => 23000, 'jumlah' => 1],
            ['detail_id' => 27, 'penjualan_id' => 9, 'barang_id' => 12, 'harga' => 8500, 'jumlah' => 3],

            // --- Penjualan ID 10 ---
            ['detail_id' => 28, 'penjualan_id' => 10, 'barang_id' => 10, 'harga' => 35000, 'jumlah' => 1],
            ['detail_id' => 29, 'penjualan_id' => 10, 'barang_id' => 8, 'harga' => 15000, 'jumlah' => 1],
            ['detail_id' => 30, 'penjualan_id' => 10, 'barang_id' => 13, 'harga' => 21000, 'jumlah' => 1],
        ];

        DB::table('t_penjualan_detail')->insert($data);
    }
}
