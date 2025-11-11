<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // SUPPLIER 1
            ['barang_id' => 1, 'kategori_id' => 1, 'supplier_id' => 1, 'kode_barang' => 'B001', 'nama_barang' => 'Biskuit Coklat Crunch', 'harga_beli' => 9000, 'harga_jual' => 12000],
            ['barang_id' => 2, 'kategori_id' => 2, 'supplier_id' => 1, 'kode_barang' => 'B002', 'nama_barang' => 'Susu Steril Botol 200ml', 'harga_beli' => 7000, 'harga_jual' => 9500],
            ['barang_id' => 3, 'kategori_id' => 3, 'supplier_id' => 1, 'kode_barang' => 'B003', 'nama_barang' => 'Detergen Cair Wangi', 'harga_beli' => 16000, 'harga_jual' => 21000],
            ['barang_id' => 4, 'kategori_id' => 4, 'supplier_id' => 1, 'kode_barang' => 'B004', 'nama_barang' => 'Pulpen Gel Hitam Premium', 'harga_beli' => 5000, 'harga_jual' => 7500],
            ['barang_id' => 5, 'kategori_id' => 5, 'supplier_id' => 1, 'kode_barang' => 'B005', 'nama_barang' => 'Lampu LED 9 Watt', 'harga_beli' => 17000, 'harga_jual' => 23000],

            // SUPPLIER 2
            ['barang_id' => 6, 'kategori_id' => 1, 'supplier_id' => 2, 'kode_barang' => 'B006', 'nama_barang' => 'Kacang Panggang Pedas', 'harga_beli' => 8000, 'harga_jual' => 11000],
            ['barang_id' => 7, 'kategori_id' => 2, 'supplier_id' => 2, 'kode_barang' => 'B007', 'nama_barang' => 'Teh Botol Original 450ml', 'harga_beli' => 3500, 'harga_jual' => 5000],
            ['barang_id' => 8, 'kategori_id' => 3, 'supplier_id' => 2, 'kode_barang' => 'B008', 'nama_barang' => 'Shampoo Herbal 180ml', 'harga_beli' => 11000, 'harga_jual' => 15000],
            ['barang_id' => 9, 'kategori_id' => 4, 'supplier_id' => 2, 'kode_barang' => 'B009', 'nama_barang' => 'Penghapus Putih Premium', 'harga_beli' => 3000, 'harga_jual' => 5000],
            ['barang_id' => 10, 'kategori_id' => 5, 'supplier_id' => 2, 'kode_barang' => 'B010', 'nama_barang' => 'Adaptor Charger Fast 2A', 'harga_beli' => 27000, 'harga_jual' => 35000],

            // SUPPLIER 3
            ['barang_id' => 11, 'kategori_id' => 1, 'supplier_id' => 3, 'kode_barang' => 'B011', 'nama_barang' => 'Cereal Sarapan Madu', 'harga_beli' => 13000, 'harga_jual' => 18000],
            ['barang_id' => 12, 'kategori_id' => 2, 'supplier_id' => 3, 'kode_barang' => 'B012', 'nama_barang' => 'Minuman Soda Kaleng 320ml', 'harga_beli' => 6000, 'harga_jual' => 8500],
            ['barang_id' => 13, 'kategori_id' => 3, 'supplier_id' => 3, 'kode_barang' => 'B013', 'nama_barang' => 'Pembersih Lantai Lemon', 'harga_beli' => 15000, 'harga_jual' => 21000],
            ['barang_id' => 14, 'kategori_id' => 4, 'supplier_id' => 3, 'kode_barang' => 'B014', 'nama_barang' => 'Kertas HVS A4 80gsm', 'harga_beli' => 39000, 'harga_jual' => 48000],
            ['barang_id' => 15, 'kategori_id' => 5, 'supplier_id' => 3, 'kode_barang' => 'B015', 'nama_barang' => 'Speaker Mini Portable', 'harga_beli' => 55000, 'harga_jual' => 85000],
        ];

        DB::table('m_barang')->insert($data);
    }
}
