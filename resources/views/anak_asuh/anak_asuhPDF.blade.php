<!DOCTYPE html>
<html>
<head>
    <title>Data Anak Asuh</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h3 align="center">Data Anak Asuh</h3>
    <table border="1" cellpadding="10" align="center">
    <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Gender</th>
                <th>Pendidikan</th>
            </tr>
        </thead>
        <tbody>
            @php $no= 1; @endphp
            @foreach ($anak_asuh as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->tmp_lahir }}</td>
                <td>{{ $row->tgl_lahir }}</td>
                <td>{{ $row->gender }}</td>
                <td>{{ $row->pendidikan }}</td>
            </tr>
            @endforeach
        </tbody>
</table>
</body>
</html>