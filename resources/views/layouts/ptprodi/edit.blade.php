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
                <label for="id_pt">Perguruan Tinggi</label>
                <select name="id_pt" id="id_pt" class="form-control">
                    @foreach ($data_pt as $pt)
                    <option value="{{ $pt->id }}" <?php if ($pt->id == $ptprodi->id_pt) echo "selected"; ?>>{{ $pt->nama_pt }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_prodi">Prodi</label>
                <select name="id_prodi" id="id_prodi" class="form-control">
                    @foreach ($data_prodi as $prodi)
                    <option value="{{ $prodi->id }}" <?php if ($prodi->id == $ptprodi->id_prodi) echo "selected"; ?>>{{ $prodi->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="jenjang">Jenjang</label>
                <select type="text" name="jenjang" id="jenjang" class="form-control" value="{{ $ptprodi->jenjang }}" maxlength="255" required>
                    <option value="D3" <?php if ($ptprodi->jenjang == "D3") echo "selected"; ?>>D3</option>
                    <option value="D4" <?php if ($ptprodi->jenjang == "D4") echo "selected"; ?>>D4</option>
                    <option value="S1" <?php if ($ptprodi->jenjang == "S1") echo "selected"; ?>>S1</option>
                    <option value="S2" <?php if ($ptprodi->jenjang == "S2") echo "selected"; ?>>S2</option>
                    <option value="Profesi" <?php if ($ptprodi->jenjang == "Profesi") echo "selected"; ?>>Profesi</option>
                    <option value="S3" <?php if ($ptprodi->jenjang == "S3") echo "selected"; ?>>S3</option>
                </select>
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
                <label for="tanggal_berlaku">Tanggal Berlaku</label>
                <input type="date" name="tanggal_berlaku" id="tanggal_berlaku" class="form-control" value="{{ $ptprodi->tanggal_berlaku }}" maxlength="255" required>
            </div>

            <div class="form-group">
                <label for="jumlah_dosen">Jumlah Dosen</label>
                <input type="text" name="jumlah_dosen" id="jumlah_dosen" class="form-control" value="{{ $ptprodi->jumlah_dosen }}" maxlength="255" required>
            </div>
            <div class="form-group">
                <label for="jumlah_mahasiswa">Jumlah Mahasiswa</label>
                <input type="text" name="jumlah_mahasiswa" id="jumlah_mahasiswa" class="form-control" value="{{ $ptprodi->jumlah_mahasiswa }}" maxlength="255" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </section>
</div>
@endsection