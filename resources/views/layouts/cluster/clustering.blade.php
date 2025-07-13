@extends('layouts.app')

@section('title', 'Clustering Mahasiswa')

@push('style')
<!-- CSS Libraries -->
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Clustering Mahasiswa</h1>
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
            <form method="POST" action="{{ route('algoritma') }}">
                @csrf

                <div class="form-group">
                    <label for="id_prodi">Program Studi</label>
                    <select name="id_prodi" id="id_prodi" class="form-control" required>
                        @php
            // Mengurutkan $data_prodi berdasarkan nama program studi
            $data_prodi = $data_prodi->sortBy('nama');
                        @endphp
                        @foreach ($data_prodi as $prodi)
                        <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jenjang">Jenjang</label>
                    <select name="jenjang" id="jenjang" class="form-control" required>
                        <option value="All">Semua</option>
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
                    <select name="id_batch" id="id_batch" class="form-control" required>
                        <option value="All">Semua</option>
                        @foreach ($data_batch as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="num_cluster">Jumlah Cluster</label>
                    <input type="number" name="num_cluster" id="num_cluster" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Cluster</button>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraries -->

<!-- Page Specific JS File -->
@endpush