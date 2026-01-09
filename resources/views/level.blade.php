<!DOCTYPE html>
<html>
<head>
    <title>Data Level</title>
    <style>
        table {
            border-collapse: collapse;
            width: 60%;
            margin: 30px auto;
        }
        table, th, td {
            border: 1px solid #333;
            padding: 8px;
        }
        th {
            background: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Daftar Data Level</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Kode Level</th>
            <th>Nama Level</th>
            <th>Created At</th>
        </tr>

        @foreach($data as $item)
        <tr>
            <td>{{ $item->level_id }}</td>
            <td>{{ $item->level_kode }}</td>
            <td>{{ $item->level_nama }}</td>
            <td>{{ $item->created_at }}</td>
        </tr>
        @endforeach

    </table>

</body>
</html>
