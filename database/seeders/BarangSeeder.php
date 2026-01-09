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
            ['barang_id' => 1, 'kategori_id' => 1, 'supplier_id' => 1, 'barang_kode' => 'B001', 'barang_nama' => 'Biskuit Coklat Crunch', 'harga_beli' => 9000, 'harga_jual' => 12000],
            ['barang_id' => 2, 'kategori_id' => 2, 'supplier_id' => 1, 'barang_kode' => 'B002', 'barang_nama' => 'Susu Steril Botol 200ml', 'harga_beli' => 7000, 'harga_jual' => 9500],
            ['barang_id' => 3, 'kategori_id' => 3, 'supplier_id' => 1, 'barang_kode' => 'B003', 'barang_nama' => 'Detergen Cair Wangi', 'harga_beli' => 16000, 'harga_jual' => 21000],
            ['barang_id' => 4, 'kategori_id' => 4, 'supplier_id' => 1, 'barang_kode' => 'B004', 'barang_nama' => 'Pulpen Gel Hitam Premium', 'harga_beli' => 5000, 'harga_jual' => 7500],
            ['barang_id' => 5, 'kategori_id' => 5, 'supplier_id' => 1, 'barang_kode' => 'B005', 'barang_nama' => 'Lampu LED 9 Watt', 'harga_beli' => 17000, 'harga_jual' => 23000],

            // SUPPLIER 2
            ['barang_id' => 6, 'kategori_id' => 1, 'supplier_id' => 2, 'barang_kode' => 'B006', 'barang_nama' => 'Kacang Panggang Pedas', 'harga_beli' => 8000, 'harga_jual' => 11000],
            ['barang_id' => 7, 'kategori_id' => 2, 'supplier_id' => 2, 'barang_kode' => 'B007', 'barang_nama' => 'Teh Botol Original 450ml', 'harga_beli' => 3500, 'harga_jual' => 5000],
            ['barang_id' => 8, 'kategori_id' => 3, 'supplier_id' => 2, 'barang_kode' => 'B008', 'barang_nama' => 'Shampoo Herbal 180ml', 'harga_beli' => 11000, 'harga_jual' => 15000],
            ['barang_id' => 9, 'kategori_id' => 4, 'supplier_id' => 2, 'barang_kode' => 'B009', 'barang_nama' => 'Penghapus Putih Premium', 'harga_beli' => 3000, 'harga_jual' => 5000],
            ['barang_id' => 10, 'kategori_id' => 5, 'supplier_id' => 2, 'barang_kode' => 'B010', 'barang_nama' => 'Adaptor Charger Fast 2A', 'harga_beli' => 27000, 'harga_jual' => 35000],

            // SUPPLIER 3
            ['barang_id' => 11, 'kategori_id' => 1, 'supplier_id' => 3, 'barang_kode' => 'B011', 'barang_nama' => 'Cereal Sarapan Madu', 'harga_beli' => 13000, 'harga_jual' => 18000],
            ['barang_id' => 12, 'kategori_id' => 2, 'supplier_id' => 3, 'barang_kode' => 'B012', 'barang_nama' => 'Minuman Soda Kaleng 320ml', 'harga_beli' => 6000, 'harga_jual' => 8500],
            ['barang_id' => 13, 'kategori_id' => 3, 'supplier_id' => 3, 'barang_kode' => 'B013', 'barang_nama' => 'Pembersih Lantai Lemon', 'harga_beli' => 15000, 'harga_jual' => 21000],
            ['barang_id' => 14, 'kategori_id' => 4, 'supplier_id' => 3, 'barang_kode' => 'B014', 'barang_nama' => 'Kertas HVS A4 80gsm', 'harga_beli' => 39000, 'harga_jual' => 48000],
            ['barang_id' => 15, 'kategori_id' => 5, 'supplier_id' => 3, 'barang_kode' => 'B015', 'barang_nama' => 'Speaker Mini Portable', 'harga_beli' => 55000, 'harga_jual' => 85000],
        ];

        DB::table('m_barang')->insert($data);
    }
}