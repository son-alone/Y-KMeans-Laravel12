@extends('layouts.app')

@section('title', 'Tambah Data Yudisium')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Yudisium</h1>
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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="section-body">
                <form action="{{ route('yudisium.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="id_batch">Batch</label>
                        <select name="id_batch" id="id_batch" class="form-control" required>
                            @foreach ($data_batch as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_batch')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="id_pt">Perguruan Tinggi</label>
                        <select name="id_pt" id="id_pt" class="form-control" required>
                            @foreach ($data_pt as $pt)
                                <option value="{{ $pt->id }}">{{ $pt->nama_pt }}</option>
                            @endforeach
                        </select>
                        @error('id_pt')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_yudisium">Tanggal Yudisium</label>
                        <input type="date" name="tanggal_yudisium" id="tanggal_yudisium" class="form-control" required>
                        @error('tanggal_yudisium')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="file">Upload File</label>
                        <input type="file" name="file" id="file" class="form-control">
                        @error('file')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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
