// File: resources/views/mahasiswa/index.blade.php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa Berprestasi</title>
</head>
<body>
    <h1>Data Mahasiswa Berprestasi</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nama</th>
                <th>IPK</th>
                <th>Jumlah SKS</th>
                <th>Lama Lulus (Bulan)</th>
                <th>Cluster</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $mhs)
                <tr>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->ipk }}</td>
                    <td>{{ $mhs->jumlah_sks }}</td>
                    <td>{{ \Carbon\Carbon::parse($mhs->tanggal_masuk)->diffInMonths(\Carbon\Carbon::parse($mhs->tanggal_lulus)) }}</td>
                    <td>{{ $mhs->cluster }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tombol untuk menjalankan clustering -->
    <form action="{{ url('/mahasiswa/cluster') }}" method="POST">
        @csrf
        <button type="submit">Jalankan Clustering</button>
    </form>
</body>
</html>
