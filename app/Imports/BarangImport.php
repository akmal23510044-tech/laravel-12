<?php

namespace App\Imports;

use App\Models\BarangModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // 1. Ambil Kode (Cari berbagai kemungkinan nama kolom)
        $kode = $row['kode_barang'] ?? $row['kode'] ?? $row['code'] ?? null;
        $nama = $row['nama_barang'] ?? $row['nama'] ?? 'Tanpa Nama';
        $beli = $row['harga_beli']  ?? $row['beli'] ?? 0;
        $jual = $row['harga_jual']  ?? $row['jual'] ?? 0;
        $kat_id = $row['kategori_id'] ?? $row['kategori'] ?? 1;
        $sup_id = $row['supplier_id'] ?? $row['supplier'] ?? null;

        // 2. Validasi: Kalau kode kosong, lewati
        if (empty($kode)) {
            return null;
        }

        // 3. JURUS ANDALAN: updateOrCreate
        // Artinya: Cari barang dengan kode tersebut.
        // Kalau ketemu -> Update isinya.
        // Kalau tidak ketemu -> Buat baru.
        
        $barang = BarangModel::where('barang_kode', $kode)->first();

        if ($barang) {
            // JIKA SUDAH ADA, KITA UPDATE DATANYA
            $barang->update([
                'barang_nama' => $nama,
                'harga_beli'  => $beli,
                'harga_jual'  => $jual,
                'kategori_id' => $kat_id,
                'supplier_id' => $sup_id,
            ]);
            
            return null; // Return null supaya ToModel tidak mencoba insert ganda
        } else {
            // JIKA BELUM ADA, BUAT BARU
            return new BarangModel([
                'barang_kode' => $kode,
                'barang_nama' => $nama,
                'harga_beli'  => $beli,
                'harga_jual'  => $jual,
                'kategori_id' => $kat_id,
                'supplier_id' => $sup_id,
            ]);
        }
    }
}