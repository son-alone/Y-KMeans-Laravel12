@extends('layouts.app')

@section('title', 'Data Detail Yudisium')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Detail Yudisium</h1>
            </div>
            <form action="{{ route('detail.update', $detail->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                <label for="id_yudisium">Tanggal Yudisium</label>
                <select name="id_yudisium" id="id_yudisium" class="form-control">
                    @foreach ($data_yudisium as $yudisium)
                    <option value="{{ $yudisium->id }}" <?php if ($yudisium->id == $detail->id) echo "selected"; ?>>{{ $yudisium->tanggal_yudisium }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_pt">Perguruan Tinggi</label>
                <select name="id_pt" id="id_pt" class="form-control">
                    @foreach ($data_pt as $pt)
                    <option value="{{ $pt->id }}" <?php if ($pt->id == $detail->id_pt) echo "selected"; ?>>{{ $pt->nama_pt }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_prodi">Prodi</label>
                <select name="id_prodi" id="id_prodi" class="form-control">
                    @foreach ($data_prodi as $prodi)
                    <option value="{{ $prodi->id }}" <?php if ($prodi->id == $detail->id_prodi) echo "selected"; ?>>{{ $prodi->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="jenjang">Jenjang</label>
                <select type="text" name="jenjang" id="jenjang" class="form-control" value="{{ $detail->jenjang }}" maxlength="255" required>
                    <option value="D3" <?php if ($detail->jenjang == "D3") echo "selected"; ?>>D3</option>
                    <option value="D4" <?php if ($detail->jenjang == "D4") echo "selected"; ?>>D4</option>
                    <option value="S1" <?php if ($detail->jenjang == "S1") echo "selected"; ?>>S1</option>
                    <option value="S2" <?php if ($detail->jenjang == "S2") echo "selected"; ?>>S2</option>
                    <option value="Profesi" <?php if ($detail->jenjang == "Profesi") echo "selected"; ?>>Profesi</option>
                    <option value="S3" <?php if ($detail->jenjang == "S3") echo "selected"; ?>>S3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="id_batch">Batch</label>
                <select name="id_batch" id="id_batch" class="form-control">
                    @foreach ($data_batch as $batch)
                    <option value="{{ $batch->id }}" <?php if ($batch->id == $detail->id_batch) echo "selected"; ?>>{{ $batch->nama }}</option>
                    @endforeach
                </select>
            </div>

            
                    <div class="form-group">
                        <label for="npm">NPM</label>
                        <input type="text" name="npm" id="npm" class="form-control" value="{{ $detail->npm }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_mhs">Nama Mahasiswa</label>
                        <input type="text" name="nama_mhs" id="nama_mhs" class="form-control" value="{{ $detail->nama_mhs }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="ipk">IPK</label>
                        <input type="double" name="ipk" id="ipk" class="form-control" value="{{ $detail->ipk }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="jml_sks">Jumlah SKS</label>
                        <input type="number" name="jml_sks" id="jml_sks" class="form-control" value="{{ $detail->jml_sks }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_masuk">Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control" value="{{ $detail->tgl_masuk }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lulus">Tanggal Lulus</label>
                        <input type="date" name="tgl_lulus" id="tgl_lulus" class="form-control" value="{{ $detail->tgl_lulus }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <input type="text" name="jk" id="jk" class="form-control" value="{{ $detail->jk }}" maxlength="255" required>
                    </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </section>
    </div>
@endsection
