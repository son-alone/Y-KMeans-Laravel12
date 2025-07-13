@extends('layouts.app')

@section('title', 'Provinsi')

@push('style')
<!-- CSS Libraries -->
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Provinsi</h1>
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
                    @can('provinsi-create')
                    <a href="{{ route('provinsi.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                    @endcan
                        <form action="{{ route('provinsi.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari Berdasarkan Nama Provinsi">
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
                            <th>Provinsi</th>
                            <th>Logo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($provinsi as $item)
                        <tr>
                            <td>{{ $item->nama_provinsi }}</td>
                            <td>
    @if ($item->logo && file_exists(public_path('uploads/' . $item->logo)))
        <img src="{{ asset('uploads/' . $item->logo) }}" alt="Logo" width="60">
    @else
        <span class="text-muted">Tidak ada logo</span>
    @endif
</td>
                            <td>
                                @can('provinsi-edit')
                                <a href="{{ route('provinsi.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                @endcan

                                @can('provinsi-delete')
                                <form action="{{ route('provinsi.delete', $item->id) }}" method="POST" style="display: inline-block;">
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