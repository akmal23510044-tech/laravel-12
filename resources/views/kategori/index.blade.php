@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-layer-group mr-1"></i> {{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/kategori/import') }}')" class="btn btn-sm btn-info mt-1">
                <i class="fas fa-cloud-upload-alt"></i> Import
            </button>
            <a href="{{ url('/kategori/export_excel') }}" class="btn btn-sm btn-primary mt-1">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ url('/kategori/export_pdf') }}" class="btn btn-sm btn-warning mt-1">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            <button onclick="modalAction('{{ url('/kategori/create_ajax') }}')" class="btn btn-sm btn-success mt-1">
                <i class="fas fa-plus-circle"></i> Tambah Baru
            </button>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                {{ session('success') }}
            </div>
        @endif
        
        <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
            <thead>
                <tr>
                    <th style="width: 5%;" class="text-center">No</th>
                    <th style="width: 20%;">Kode Kategori</th>
                    <th>Nama Kategori</th>
                    <th style="width: 15%;" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }
    
    var dataKategori;
    $(document).ready(function() {
        dataKategori = $('#table_kategori').DataTable({
            serverSide: true,
            processing: true, // Tampilkan loading indicator
            ajax: {
                "url": "{{ url('kategori/list') }}",
                "dataType": "json",
                "type": "POST",
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "kategori_kode", className: "text-center", orderable: true, searchable: true },
                { data: "kategori_nama", className: "", orderable: true, searchable: true },
                { data: "aksi", className: "text-center", orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush