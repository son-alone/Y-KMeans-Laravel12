@extends('layouts.app')

@section('title', 'Data Provinsi')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Provinsi</h1>
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
                    <input type="file" name="logo" id="logo" class="form-control" value="{{ $provinsi->logo }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </section>
    </div>
@endsection
