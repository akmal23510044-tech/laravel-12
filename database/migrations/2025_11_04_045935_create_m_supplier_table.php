<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('m_supplier', function (Blueprint $table) {
            $table->id('supplier_id');
            
            // --- PERBAIKAN KOLOM DISINI ---
            $table->string('supplier_kode', 10)->unique(); // Menambahkan supplier_kode
            $table->string('supplier_nama', 100);          // Mengganti nama_supplier jadi supplier_nama
            $table->string('supplier_alamat', 255);        // Mengganti alamat jadi supplier_alamat
            // ------------------------------
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('m_supplier');
    }
};