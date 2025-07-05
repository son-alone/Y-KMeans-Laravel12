@extends('layouts.app')

@section('title', 'Tambah Data Detail Yudisium')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Detail Yudisium</h1>
            </div>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="section-body">
            <form action="{{ route('detail.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_yudisium">Tanggal Yudisium</label>
                    <select name="id_yudisium" id="id_yudisium" class="form-control">
                        @foreach ($data_yudisium as $yudisium)
                        <option value="{{ $yudisium->id }}">{{ $yudisium->tanggal_yudisium }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_pt">Perguruan Tinggi</label>
                    <select name="id_pt" id="id_pt" class="form-control">
                        @foreach ($data_pt as $pt)
                        <option value="{{ $pt->id }}">{{ $pt->nama_pt }}</option>
                        @endforeach
                    </select>
                </div>

                    <div class="form-group">
                    <label for="id_prodi">Prodi</label>
                    <select name="id_prodi" id="id_prodi" class="form-control">
                        @foreach ($data_prodi as $prodi)
                        <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="jenjang">Jenjang</label>
                    <select type="text" name="jenjang" id="jenjang" class="form-control">
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="Profesi">Profesi</option>
                        <option value="S3">S3</option>
                    </select>
                </div>

                    <div class="form-group">
                    <label for="id_batch">Batch</label>
                    <select name="id_batch" id="id_batch" class="form-control">
                        @foreach ($data_batch as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->nama }}</option>
                        @endforeach
                    </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="npm">NPM</label>
                        <input type="text" name="npm" id="npm" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_mhs">Nama Mahasiswa</label>
                        <input type="text" name="nama_mhs" id="nama_mhs" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ipk">IPK</label>
                        <input type="double" name="ipk" id="ipk" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jml_sks">Jumlah SKS</label>
                        <input type="number" name="jml_sks" id="jml_sks" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tgl_masuk">Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tgl_lulus">Tanggal Lulus</label>
                        <input type="date" name="tgl_lulus" id="tgl_lulus" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <input type="text" name="jk" id="jk" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->

    <!-- Page Specific JS File -->
@endpush
