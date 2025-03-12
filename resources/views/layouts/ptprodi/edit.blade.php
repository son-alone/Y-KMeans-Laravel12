@extends('layouts.app')

@section('title', 'Data PT Prodi')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data PT Prodi</h1>
            </div>
            <form action="{{ route('ptprodi.update', $ptprodi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="id_pt">ID PT</label>
                    <input type="number" name="id_pt" id="id_pt" class="form-control" value="{{ $ptprodi->id_pt }}" maxlength="255" required>
                </div>

                <div class="form-group">
                        <label for="id_prodi">ID Prodi</label>
                        <input type="number" name="id_prodi" id="id_prodi" class="form-control" value="{{ $ptprodi->id_prodi }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="jenjang">Jenjang</label>
                        <input type="text" name="jenjang" id="jenjang" class="form-control" value="{{ $ptprodi->jenjang }}" maxlength="255" required>
                    </div>

                    <div class="form-group">
                        <label for="akreditasi">Akreditasi</label>
                        <input type="text" name="akreditasi" id="akreditasi" class="form-control" value="{{ $ptprodi->akreditasi }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="sk">SK</label>
                        <input type="text" name="sk" id="sk" class="form-control" value="{{ $ptprodi->sk }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_berlaku">Tgl Berlaku</label>
                        <input type="date" name="tanggal_berlaku" id="tanggal_berlaku" class="form-control" value="{{ $ptprodi->tanggal_berlaku }}" maxlength="255" required>
                    </div>

                    <div class="form-group">
                        <label for="jumlah_dosen">Jml Dosen</label>
                        <input type="text" name="jumlah_dosen" id="jumlah_dosen" class="form-control" value="{{ $ptprodi->jumlah_dosen }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_mahasiswa">Jml Mhs</label>
                        <input type="text" name="jumlah_mahasiswa" id="jumlah_mahasiswa" class="form-control" value="{{ $ptprodi->jumlah_mahasiswa }}" maxlength="255" required>
                    </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </section>
    </div>
@endsection
