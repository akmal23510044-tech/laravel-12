<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\SupplierModel; // <--- WAJIB DITAMBAHKAN
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\BarangImport;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    public function index()
    {
        $activeMenu = 'barang';
        $breadcrumb = (object) [
            'title' => 'Data Barang',
            'list' => ['Home', 'Barang']
        ];
        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];
        $kategori = KategoriModel::all();
        // Ambil supplier juga untuk filter jika perlu, atau biarkan kosong dulu
        return view('barang.index', ['activeMenu' => $activeMenu, 'breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori]);
    }

    public function list(Request $request)
    {
        // Tambahkan with('supplier') jika ingin menampilkan nama supplier di tabel
        $barang = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'kategori_id', 'supplier_id')
            ->with(['kategori', 'supplier']); 

        if ($request->kategori_id) {
            $barang->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) {
                $btn  = '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i> Edit</button>';
                $btn .= '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // --- FORM TAMBAH (AJAX) ---
    public function create_ajax()
    {
        $kategori = KategoriModel::all();
        $supplier = SupplierModel::all(); // <--- AMBIL DATA SUPPLIER
        
        return view('barang.create_ajax', [
            'kategori' => $kategori, 
            'supplier' => $supplier
        ]);
    }

    // --- PROSES SIMPAN (AJAX) ---
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_id' => 'required|integer',
                'supplier_id' => 'required|integer', // <--- WAJIB ADA VALIDASI INI
                'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode',
                'barang_nama' => 'required|string|max:100',
                'harga_beli'  => 'required|numeric',
                'harga_jual'  => 'required|numeric',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            BarangModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data barang berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    // --- 5. FORM EDIT (AJAX) ---
    public function edit_ajax(string $id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();
        $supplier = SupplierModel::all();
        return view('barang.edit_ajax', ['barang' => $barang, 'kategori' => $kategori]);
    }

    // --- 6. PROSES UPDATE (AJAX) ---
    public function update_ajax(Request $request, $id)
    {
         if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_id' => 'required|integer',
                'supplier_id' => 'required|integer', // <--- Tambahkan Validasi
                'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode,'.$id.',barang_id',
                'barang_nama' => 'required|string|max:100',
                'harga_beli'  => 'required|numeric',
                'harga_jual'  => 'required|numeric',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $check = BarangModel::find($id);
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

    // --- 7. CONFIRM DELETE (AJAX) ---
    public function confirm_ajax(string $id)
    {
        $barang = BarangModel::find($id);
        return view('barang.confirm_ajax', ['barang' => $barang]);
    }

    // --- 8. DELETE (AJAX) ---
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $barang = BarangModel::find($id);
            if ($barang) {
                $barang->delete();
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

    // --- 9. IMPORT ---
    public function import()
    {
        return view('barang.import');
    }

    public function import_ajax(Request $request)
    {
        if($request->ajax() || $request->wantsJson()){
            $rules = [
                'file_barang' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            try {
                Excel::import(new BarangImport, $request->file('file_barang'));
                return response()->json([
                    'status' => true,
                    'message' => 'Data Berhasil Diimport!'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi Error: ' . $e->getMessage()
                ]);
            }
        }
        return redirect('/');
    }

    // --- 10. EXPORT & DOWNLOAD ---
    public function export_excel()
    {
        // ... (Kode export excel Anda sebelumnya)
    }

    public function export_pdf()
    {
        $barang = BarangModel::select('kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')
            ->orderBy('kategori_id')
            ->orderBy('barang_kode')
            ->with('kategori')
            ->get();

        $pdf = Pdf::loadView('barang.export_pdf', ['barang' => $barang]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption("isRemoteEnabled", true); 
        return $pdf->stream('Data Barang ' . date('Y-m-d H:i:s') . '.pdf');
    }
    
    public function download_template()
    {
         // Logic download template jika ada
    }
}