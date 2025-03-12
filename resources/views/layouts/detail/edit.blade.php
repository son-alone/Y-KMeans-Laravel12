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
                        <label for="id_yudisium">id_yudisium</label>
                        <input type="number" name="id_yudisium" id="id_yudisium" class="form-control" value="{{ $detail->id_yudisium }}" maxlength="255" required>
                    </div>

                    <div class="form-group">
                        <label for="id_prodi">id_prodi</label>
                        <input type="number" name="id_prodi" id="id_prodi" class="form-control" value="{{ $detail->id_prodi }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="npm">npm</label>
                        <input type="text" name="npm" id="npm" class="form-control" value="{{ $detail->npm }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_mhs">nama_mhs</label>
                        <input type="text" name="nama_mhs" id="nama_mhs" class="form-control" value="{{ $detail->nama_mhs }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="ipk">ipk</label>
                        <input type="double" name="ipk" id="ipk" class="form-control" value="{{ $detail->ipk }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="jml_sks">jml_sks</label>
                        <input type="number" name="jml_sks" id="jml_sks" class="form-control" value="{{ $detail->jml_sks }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_masuk">tgl_masuk</label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control" value="{{ $detail->tgl_masuk }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="jk">jk</label>
                        <input type="text" name="jk" id="jk" class="form-control" value="{{ $detail->jk }}" maxlength="255" required>
                    </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </section>
    </div>
@endsection
