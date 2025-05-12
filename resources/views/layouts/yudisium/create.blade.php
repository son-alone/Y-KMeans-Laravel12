@extends('layouts.app')

@section('title', 'Tambah Data Yudisium')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data PT</h1>
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
            <form action="{{ route('yudisium.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id_batch">id_batch</label>
                    <select name="id_batch" id="id_batch">
                        @foreach ($data_batch as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->nama }}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="id_pt">id_pt</label>
                    <select name="id_pt" id="id_pt">
                        @foreach ($data_pt as $pt)
                        <option value="{{ $pt->id }}">{{ $pt->nama_pt }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_yudisium">tanggal_yudisium</label>
                        <input type="date" name="tanggal_yudisium" id="tanggal_yudisium" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_verifikasi">tanggal_verifikasi</label>
                        <input type="date" name="tanggal_verifikasi" id="tanggal_verifikasi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="id_verifikator">id_verifikator</label>
                        <input type="number" name="id_verifikator" id="id_verifikator" class="form-control">
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
