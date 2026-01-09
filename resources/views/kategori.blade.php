<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori Barang</title>
</head>
<body>

<h1>Data Kategori Barang</h1>

<table border="1" cellpadding="2" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>kode kategori</th>
        <th>Nama Kategori</th>
        <th>Keterangan</th>
    </tr>

    @foreach ($data as $d)
    <tr>
        <td>{{ $d->kategori_id }}</td>
        <td>{{ $d->kategori_kode }}</td>
        <td>{{ $d->kategori_nama }}</td>
        <td>{{ $d->keterangan }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>
