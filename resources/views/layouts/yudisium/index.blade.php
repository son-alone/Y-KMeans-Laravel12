@extends('layouts.app')

@section('title', 'Yudisium')

@push('style')
<!-- CSS Libraries -->
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Yudisium</h1>
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
            <div class="table-responsive">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <a href="{{ route('yudisium.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                        <form action="{{ route('yudisium.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari Berdasarkan Kode Pt...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" style="margin-left:5px;" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id Batch</th>
                            <th>Id PT</th>
                            <th>Tgl Yudisium</th>
                            <th>File</th>
                            <th>Tgl Verifikasi</th>
                            <th>Id Verifikator</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($yudisium as $item)
                        <tr>
                            <td>{{ $item->batch?->nama }}</td>
                            <td>{{ $item->pt?->nama_pt }}</td>
                            <td>{{ $item->tanggal_yudisium }}</td>
                            <td>{{ $item->file }}</td>
                            <td>{{ $item->tanggal_verifikasi }}</td>
                            <td>{{ $item->id_verifikator }}</td>
                            <td>
                                <a href="{{ route('verifikasi', $item->id) }}" class="btn btn-danger">Verifikasi</a>
                                <a href="{{ route('yudisium.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('yudisium.delete', $item->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td> <!-- Add Edit and Delete buttons for each row -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraries -->

<!-- Page Specific JS File -->
@endpush