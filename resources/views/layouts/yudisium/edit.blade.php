@extends('layouts.app')

@section('title', 'Data Yudisium')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Yudisium</h1>
            </div>

            {{-- Tampilkan notifikasi sukses/gagal --}}
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

            {{-- Tampilkan validasi error global --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('yudisium.update', $yudisium->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="id_batch">Batch</label>
                    <select name="id_batch" id="id_batch" class="form-control" required>
                        @foreach ($data_batch as $batch)
                            <option value="{{ $batch->id }}" {{ $batch->id == $yudisium->id_batch ? 'selected' : '' }}>{{ $batch->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_pt">Perguruan Tinggi</label>
                    <select name="id_pt" id="id_pt" class="form-control" required>
                        @foreach ($data_pt as $pt)
                            <option value="{{ $pt->id }}" {{ $pt->id == $yudisium->id_pt ? 'selected' : '' }}>{{ $pt->nama_pt }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal_yudisium">Tanggal Yudisium</label>
                    <input type="date" name="tanggal_yudisium" id="tanggal_yudisium" class="form-control" value="{{ $yudisium->tanggal_yudisium }}" required>
                </div>

                <div class="form-group">
                    <label for="file">Upload File</label>
                    @if ($yudisium->file)
                        <p>File saat ini: <strong>{{ basename($yudisium->file) }}</strong></p>
                    @else
                        <p><em>Tidak ada file yang diunggah</em></p>
                    @endif

                    <input type="file" name="file" id="file" class="form-control mt-2">

                    {{-- ❗️ Menampilkan error validasi khusus untuk field file --}}
                    @error('file')
                        <span class="text-danger d-block mt-1">{{ $message }}</span>
                    @enderror

                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti file. File harus berupa PDF maksimal 10 MB.</small>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </section>
    </div>
@endsection