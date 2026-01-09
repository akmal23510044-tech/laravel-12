<form action="{{ url('/barang/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle"></i> Tambah Data Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kategori Barang</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                </div>
                                <select name="kategori_id" id="kategori_id" class="form-control" required>
                                    <option value="">- Pilih Kategori -</option>
                                    @foreach($kategori as $l)
                                        <option value="{{ $l->kategori_id }}">{{ $l->kategori_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <small id="error-kategori_id" class="error-text form-text text-danger"></small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Supplier</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-truck"></i></span>
                                </div>
                                <select name="supplier_id" id="supplier_id" class="form-control" required>
                                    <option value="">- Pilih Supplier -</option>
                                    @foreach($supplier as $s)
                                        <option value="{{ $s->supplier_id }}">{{ $s->supplier_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <small id="error-supplier_id" class="error-text form-text text-danger"></small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Kode Barang</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                        </div>
                        <input value="" type="text" name="barang_kode" id="barang_kode" class="form-control" placeholder="Contoh: BRG001" required>
                    </div>
                    <small id="error-barang_kode" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Nama Barang</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-box"></i></span>
                        </div>
                        <input value="" type="text" name="barang_nama" id="barang_nama" class="form-control" placeholder="Contoh: Laptop Asus" required>
                    </div>
                    <small id="error-barang_nama" class="error-text form-text text-danger"></small>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga Beli</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input value="" type="number" name="harga_beli" id="harga_beli" class="form-control" required>
                            </div>
                            <small id="error-harga_beli" class="error-text form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga Jual</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input value="" type="number" name="harga_jual" id="harga_jual" class="form-control" required>
                            </div>
                            <small id="error-harga_jual" class="error-text form-text text-danger"></small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-tambah").validate({
            rules: {
                kategori_id: { required: true, number: true },
                supplier_id: { required: true, number: true }, // Tambahan validasi JS
                barang_kode: { required: true, minlength: 3, maxlength: 20 },
                barang_nama: { required: true, minlength: 3, maxlength: 100 },
                harga_beli: { required: true, number: true },
                harga_jual: { required: true, number: true }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({ icon: 'success', title: 'Berhasil', text: response.message });
                            dataBarang.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({ icon: 'error', title: 'Terjadi Kesalahan', text: response.message });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) { $(element).addClass('is-invalid'); },
            unhighlight: function(element, errorClass, validClass) { $(element).removeClass('is-invalid'); }
        });
    });
</script>