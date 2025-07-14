@extends('layouts.app')

@section('title', 'ptprodi')

@push('style')
<!-- CSS Libraries -->
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Prodi dan Perguruan Tinggi</h1>
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
                        <a href="{{ route('ptprodi.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                        <form action="{{ route('ptprodi.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari Berdasarkan SK">
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
                            <th>Perguruan Tinggi</th>
                            <th>Prodi</th>
                            <th>Jenjang</th>
                            <th>Akreditasi</th>
                            <th>SK</th>
                            <th>Tanggal Berlaku</th>
                            <th>Jumlah Dosen</th>
                            <th>Jumlah Mahasiswa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ptprodi as $item)
                        <tr>
                            <td>{{ $item->pt?->nama_pt }}</td>
                            <td>{{ $item->prodi?->nama }}</td>
                            <td>{{ $item->jenjang }}</td>
                            <td>{{ $item->akreditasi }}</td>
                            <td>{{ $item->sk }}</td>
                            <td>{{ $item->tanggal_berlaku }}</td>
                            <td>{{ $item->jumlah_dosen }}</td>
                            <td>{{ $item->jumlah_mahasiswa }}</td>
                            <td>
                                @can('ptprodi-edit')
                            <a href="{{ route('ptprodi.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                @endcan

                                @can('ptprodi-delete')
                            <form action="{{ route('ptprodi.delete', $item->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                @endcan
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