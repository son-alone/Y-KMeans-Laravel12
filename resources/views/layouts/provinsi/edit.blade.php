@extends('layouts.app')

@section('title', 'Data Provinsi')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Provinsi</h1>
            </div>
            <form action="{{ route('provinsi.update', $provinsi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_provinsi">Nama Provinsi</label>
                    <input type="text" name="nama_provinsi" id="nama_provinsi" class="form-control" value="{{ $provinsi->nama_provinsi }}" maxlength="255" required>
                </div>

                <div class="form-group">
    <label for="logo">Logo</label>
    @if ($provinsi->logo && file_exists(public_path('uploads/' . $provinsi->logo)))
        <div class="mb-2">
            <img src="{{ asset('uploads/' . $provinsi->logo) }}" alt="Logo Lama" width="80">
        </div>
    @endif
    <input type="file" name="logo" id="logo" class="form-control">
    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah logo.</small>
</div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </section>
    </div>
@endsection
