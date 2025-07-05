@extends('layouts.app')

@section('title', 'Pt')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Perguruan Tinggi</h1>
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
                            @can('pt-create')
                        <a href="{{ route('pt.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                            @endcan
                        <form action="{{ route('pt.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari Berdasarkan Nama Perguruan Tinggi">
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
                                <th>Perguruan Tinggi</th>
                                <th>Nomor Telepon</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Akreditasi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pt as $item)
                                <tr>
                                    <td>{{ $item->provinsi?->nama_provinsi }}</td>
                                    <td>{{ $item->nama_pt }}</td>
                                    <td>{{ $item->no_hp }}</td>  
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->akreditasi }}</td>             
                                    <td>
                                        @can('pt-edit')
                                    <a href="{{ route('pt.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                        @endcan

                                        @can('pt-delete')
                                    <form action="{{ route('pt.delete', $item->id) }}" method="POST" style="display: inline-block;">
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
