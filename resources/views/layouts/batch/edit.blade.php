@extends('layouts.app')

@section('title', 'Data Batch')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Batch</h1>
            </div>
            <form action="{{ route('batch.update', $batch->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $batch->nama }}" maxlength="255" required>
                </div>

                <div class="form-group">
                    <label for="range_awal">Range Awal</label>
                    <input type="date" name="range_awal" id="range_awal" class="form-control" value="{{ $batch->range_awal }}" required>
                </div>

                <div class="form-group">
                    <label for="range_akhir">Range Akhir</label>
                    <input type="date" name="range_akhir" id="range_akhir" class="form-control" value="{{ $batch->range_akhir }}" maxlength="255" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </section>
    </div>
@endsection
