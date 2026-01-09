<form action="{{ url('/barang/import_ajax') }}" method="POST" id="form-import" enctype="multipart/form-data">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Download Template</label>
                    <a href="{{ asset('template_barang.xlsx') }}" class="btn btn-info btn-sm" download>
                        <i class="fa fa-file-excel"></i> Download Template
                    </a>
                    <small class="form-text text-muted">Download template ini, isi datanya, lalu upload di bawah.</small>
                </div>
                <div class="form-group">
                    <label>Pilih File Excel</label>
                    <input type="file" name="file_barang" id="file_barang" class="form-control" required>
                    <small id="error-file_barang" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-import").validate({
            rules: {
                file_barang: {
                    required: true,
                    extension: "xlsx|xls"
                }
            },
            submitHandler: function(form) {
                // Tampilkan loading di tombol agar user tahu sedang proses
                var submitBtn = $(form).find('button[type="submit"]');
                var originalText = submitBtn.text();
                submitBtn.prop('disabled', true).text('Mengupload...');

                var formData = new FormData(form);

                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: formData,
                    processData: false, // WAJIB ada untuk file
                    contentType: false, // WAJIB ada untuk file
                    success: function(response) {
    if (response.status) {
        // 1. Tutup Modal
        $('#myModal').modal('hide');
        
        // 2. Tampilkan Pesan Sukses
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: response.message
        });

        // 3. INI KUNCINYA: Refresh Tabel DataTables
        if (typeof dataBarang !== 'undefined') {
            dataBarang.ajax.reload(); 
        } else {
            // Kalau variabel dataBarang tidak ketemu, refresh halaman manual
            location.reload(); 
        }
    } else {
        // Tampilkan pesan error
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: response.message
        });
    }
},
                    error: function(xhr, status, error) {
                        // Kembalikan tombol ke kondisi semula
                        submitBtn.prop('disabled', false).text(originalText);
                        
                        // MENAMPILKAN PESAN ERROR ASLI DARI SERVER (PENTING UNTUK DEBUGGING)
                        var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : "Terjadi kesalahan server (500). Cek file Controller/Import.";
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Server',
                            text: errorMessage
                        });
                    }
                });
                return false;
            }
        });
    });
</script>