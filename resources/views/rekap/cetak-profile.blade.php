<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Data</title>
    <link rel="stylesheet" href="{{asset('css/cetak.css')}}">
</head>
<body>
    <h2 style="text-align: center;">Laporan Data Tamu Kunjungan</h2>
    <table>
        <thead>
            <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>TTL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profiles as $index => $profile)
            <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $profile->nama }}</td>
            <td>{{ $profile->username }}</td>
            <td>{{ $profile->email }}</td>
            <td>{{ $profile->alamat }}</td>
            <td>{{ $profile->no_hp }}</td>
            <td>{{ $profile->tanggal_lahir }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script type="text/javascript">
    window.print();
</script>
</body>
</html>
