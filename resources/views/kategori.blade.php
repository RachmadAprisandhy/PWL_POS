<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>
</head>
<body>
    <h1>Data Kategori</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Kode</th>
            <th>Nama</th>
        </tr>

        @foreach($data as $d)
        <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->kode_kategori }}</td>
            <td>{{ $d->nama_kategori }}</td>
        </tr>
        @endforeach

    </table>
</body>
</html>