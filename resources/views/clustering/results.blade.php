@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hasil Clustering Mahasiswa</h1>
        
        <!-- Tabel Hasil Clustering -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>IPK</th>
                    <th>Jumlah SKS</th>
                    <th>Lama Lulus (Tahun)</th>
                    <th>Cluster</th>
                    <th>Kategori</th>
                    <th>Aksi</th> <!-- Kolom Aksi -->
                </tr>
            </thead>
            <tbody>
                @foreach($data_mahasiswa as $mahasiswa)
                    <tr>
                        <td>{{ $mahasiswa->nama }}</td>
                        <td>{{ $mahasiswa->ipk }}</td>
                        <td>{{ $mahasiswa->jumlah_sks }}</td>
                        <td>{{ $mahasiswa->tanggal_lulus->diffInYears($mahasiswa->tanggal_masuk) }}</td>
                        <td>{{ $mahasiswa->cluster }}</td>
                        <td>
                            @if($mahasiswa->cluster == 0)
                                Berprestasi
                            @elseif($mahasiswa->cluster == 1)
                                Normal
                            @else
                                Perlu Perhatian
                            @endif
                        </td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="/mahasiswa/{{ $mahasiswa->id }}/edit" class="btn btn-primary">Edit</a>

                            <!-- Tombol Hapus -->
                            <form action="/mahasiswa/{{ $mahasiswa->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tombol untuk Menambah Mahasiswa -->
        <a href="/mahasiswa/tambah" class="btn btn-success">Tambah Mahasiswa</a>
    </div>
@endsection
