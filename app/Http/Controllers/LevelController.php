<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        // Ambil data dari m_level
        $data = DB::select('select * from m_level');

        // Kirim ke view
        return view('level', ['data' => $data]);
    }
}
