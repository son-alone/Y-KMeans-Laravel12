@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Data Mahasiswa</h1>

        <form action="/mahasiswa/{{ $mahasiswa->id }}/update" method="POST">
            @csrf
            <label for="nama">Nama Mahasiswa</label>
            <input type="text" name="nama" value="{{ $mahasiswa->nama }}" required>

            <label for="ipk">IPK</label>
            <input type="number" name="ipk" step="0.01" value="{{ $mahasiswa->ipk }}" required>

            <label for="jumlah_sks">Jumlah SKS</label>
            <input type="number" name="jumlah_sks" value="{{ $mahasiswa->jumlah_sks }}" required>

            <label for="tanggal_masuk">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" value="{{ $mahasiswa->tanggal_masuk->toDateString() }}" required>

            <label for="tanggal_lulus">Tanggal Lulus</label>
            <input type="date" name="tanggal_lulus" value="{{ $mahasiswa->tanggal_lulus->toDateString() }}" required>

            <button type="submit">Update Mahasiswa</button>
        </form>

        <form action="/mahasiswa/{{ $mahasiswa->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus Mahasiswa</button>
        </form>
    </div>
@endsection
