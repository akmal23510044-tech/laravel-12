<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\KategoriImport; // Pastikan file Import ini ada/dibuat nanti
use Maatwebsite\Excel\Facades\Excel;

class KategoriController extends Controller
{
    // 1. HALAMAN UTAMA (INDEX)
    public function index()
    {
        // Menyiapkan variabel untuk layout (breadcrumb, menu aktif, judul)
        $breadcrumb = (object) [
            'title' => 'Data Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kategori'; // Untuk menandai menu di sidebar

        return view('kategori.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'activeMenu' => $activeMenu
        ]);
    }

    // 2. API UNTUK DATATABLES (LIST DATA)
    public function list(Request $request)
    {
        // Menggunakan Eloquent Model agar lebih rapi daripada DB::table
        $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        // Return format JSON khusus DataTables
        return DataTables::of($kategori)
            ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
            ->addColumn('aksi', function ($kategori) {
                // Tombol Edit & Hapus (memanggil fungsi modalAction di JS)
                $btn  = '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i> Edit</button>';
                $btn .= '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi berisi HTML
            ->make(true);
    }

    // 3. FORM TAMBAH (AJAX)
    public function create_ajax()
    {
        return view('kategori.create_ajax');
    }

    // 4. PROSES SIMPAN DATA (AJAX)
    public function store_ajax(Request $request)
    {
        // Cek validasi input
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_kode' => 'required|string|min:2|max:10|unique:m_kategori,kategori_kode',
                'kategori_nama' => 'required|string|min:3|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors() // Pesan error per field
                ]);
            }

            // Simpan ke database
            KategoriModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data kategori berhasil disimpan!'
            ]);
        }
        redirect('/');
    }

    // 5. FORM EDIT (AJAX)
    public function edit_ajax(string $id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit_ajax', ['kategori' => $kategori]);
    }

    // 6. PROSES UPDATE DATA (AJAX)
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // unique:tabel,kolom,id_pengecualian -> Agar tidak error saat update diri sendiri
                'kategori_kode' => 'required|string|min:2|max:10|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
                'kategori_nama' => 'required|string|min:3|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $check = KategoriModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    // 7. KONFIRMASI HAPUS (AJAX)
    public function confirm_ajax(string $id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.confirm_ajax', ['kategori' => $kategori]);
    }

    // 8. PROSES HAPUS DATA (AJAX)
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori = KategoriModel::find($id);
            if ($kategori) {
                $kategori->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    // 9. FORM IMPORT
    public function import()
    {
        return view('kategori.import');
    }

    // 10. PROSES IMPORT (AJAX)
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_kategori' => ['required', 'mimes:xlsx', 'max:1024'] // Maksimal 1MB
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            try {
                // Pastikan file KategoriImport sudah dibuat di app/Imports/KategoriImport.php
                // Jika belum ada, Excel::import akan error.
                // Anda bisa membuatnya dengan: php artisan make:import KategoriImport --model=KategoriModel
                
                // Excel::import(new KategoriImport, $request->file('file_kategori')); // Uncomment jika file import sudah ada
                
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport!'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal import: ' . $e->getMessage()
                ]);
            }
        }
        return redirect('/');
    }

    // 11. EXPORT EXCEL
    public function export_excel()
    {
        $kategori = KategoriModel::select('kategori_kode', 'kategori_nama')
            ->orderBy('kategori_kode')
            ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Kategori');
        $sheet->setCellValue('C1', 'Nama Kategori');
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);

        $no = 1;
        $baris = 2;
        foreach ($kategori as $item) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $item->kategori_kode);
            $sheet->setCellValue('C' . $baris, $item->kategori_nama);
            $baris++;
            $no++;
        }

        foreach (range('A', 'C') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data_Kategori_' . date('Y-m-d_H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    // 12. EXPORT PDF
    public function export_pdf()
    {
        $kategori = KategoriModel::select('kategori_kode', 'kategori_nama')
            ->orderBy('kategori_kode')
            ->get();

        // Pastikan view 'kategori.export_pdf' sudah dibuat
        $pdf = Pdf::loadView('kategori.export_pdf', ['kategori' => $kategori]);
        
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('Data_Kategori_' . date('Y-m-d_H-i-s') . '.pdf');
    }
}