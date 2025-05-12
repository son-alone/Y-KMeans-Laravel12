@extends('layouts.app')

@section('title', 'Data Yudisium')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Yudisium</h1>
            </div>
            <form action="{{ route('yudisium.update', $yudisium->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

            <div class="form-group">
                <label for="id_batch">Id Batch</label>
                <select name="id_batch" id="id_batch">
                    @foreach ($data_batch as $batch)
                    <option value="{{ $batch->id }}" <?php if ($batch->id == $yudisium->id_batch) echo "selected"; ?>>{{ $batch->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_pt">ID PT</label>
                <select name="id_pt" id="id_pt">
                    @foreach ($data_pt as $pt)
                    <option value="{{ $pt->id }}" <?php if ($pt->id == $yudisium->id_pt) echo "selected"; ?>>{{ $pt->nama_pt }}</option>
                    @endforeach
                </select>
            </div>

                    <div class="form-group">
                        <label for="tanggal_yudisium">tanggal_yudisium</label>
                        <input type="date" name="tanggal_yudisium" id="tanggal_yudisium" class="form-control" value="{{ $yudisium->tanggal_yudisium }}" maxlength="255" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_verifikasit">tanggal_verifikasi</label>
                        <input type="date" name="tanggal_verifikasi" id="tanggal_verifikasi" class="form-control" value="{{ $yudisium->tanggal_verifikasi }}" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label for="id_verifikator">id_verifikator</label>
                        <input type="number" name="id_verifikator" id="id_verifikator" class="form-control" value="{{ $yudisium->id_verifikator }}" maxlength="255" required>
                    </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </section>
    </div>
@endsection
