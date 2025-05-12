@extends('layouts.app')

@section('content')
    <h1>Tambah Data Mahasiswa</h1>

    <form action="{{ url('/mahasiswa') }}" method="POST">
        @csrf
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required><br><br>

        <label for="ipk">IPK:</label>
        <input type="text" name="ipk" required><br><br>

        <label for="jumlah_sks">Jumlah SKS:</label>
        <input type="number" name="jumlah_sks" required><br><br>

        <label for="tahun_masuk">Tahun Masuk:</label>
        <input type="number" name="tahun_masuk" required><br><br>

        <label for="tahun_lulus">Tahun Lulus:</label>
        <input type="number" name="tahun_lulus" required><br><br>

        <label for="cluster">Cluster:</label>
        <input type="text" name="cluster" required><br><br>

        <label for="pt_id">Universitas:</label>
<select name="pt_id" required>
    <option value="">Pilih Universitas</option>
    @foreach($pt as $ptItem)
        <option value="{{ $ptItem->id }}">{{ $ptItem->nama_pt }}</option>  <!-- Nama Universitas -->
    @endforeach
</select><br><br>


        <label for="provinsi_id">Provinsi:</label>
        <select name="provinsi_id" required>
            @foreach($provinsi as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Simpan</button>

        @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    </form>
@endsection
