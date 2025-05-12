@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Data Mahasiswa</h1>

        <form action="/mahasiswa/tambah" method="POST">
            @csrf
            <label for="nama">Nama Mahasiswa</label>
            <input type="text" name="nama" required>

            <label for="ipk">IPK</label>
            <input type="number" name="ipk" step="0.01" required>

            <label for="jumlah_sks">Jumlah SKS</label>
            <input type="number" name="jumlah_sks" required>

            <label for="tanggal_masuk">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" required>

            <label for="tanggal_lulus">Tanggal Lulus</label>
            <input type="date" name="tanggal_lulus" required>

            <label for="program_studi_id">Program Studi</label>
            <select name="program_studi_id" required>
                @foreach ($program_studi as $prodi)
                    <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                @endforeach
            </select>

            <button type="submit">Tambah Mahasiswa</button>
        </form>
    </div>
@endsection
