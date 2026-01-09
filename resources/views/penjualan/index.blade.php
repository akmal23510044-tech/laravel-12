@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
    <button onclick="modalAction('{{ url('/penjualan/import') }}')" class="btn btn-sm btn-info mt-1">Import</button>
    <a href="{{ url('/penjualan/export_excel') }}" class="btn btn-sm btn-primary mt-1">Export Excel</a>
    <a href="{{ url('/penjualan/export_pdf') }}" class="btn btn-sm btn-warning mt-1">Export PDF</a>
    <button onclick="modalAction('{{ url('/penjualan/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
</div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
            <thead>
                <tr><th>ID</th><th>Kode</th><th>Pembeli</th><th>Kasir</th><th>Tanggal</th><th>Aksi</th></tr>
            </thead>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection
@push('js')
<script>
    function modalAction(url = '') { $('#myModal').load(url, function() { $('#myModal').modal('show'); }); }
    var dataPenjualan;
    $(document).ready(function() {
        dataPenjualan = $('#table_penjualan').DataTable({
            serverSide: true,
            ajax: { "url": "{{ url('penjualan/list') }}", "dataType": "json", "type": "POST" },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "penjualan_kode", className: "", orderable: true, searchable: true },
                { data: "pembeli", className: "", orderable: true, searchable: true },
                { data: "user.nama", className: "", orderable: true, searchable: true },
                { data: "penjualan_tanggal", className: "", orderable: true, searchable: true },
                { data: "aksi", className: "", orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush