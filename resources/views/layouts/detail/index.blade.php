@extends('layouts.app')

@section('title', 'Detail Yudisium')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Yudisium</h1>
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
                            <a href="{{ route('detail.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                            <form action="{{ route('detail.index') }}" method="GET">
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
                                <th>Id Yudisium</th>
                                <th>Id Prodi</th>
                                <th>NPM</th>
                                <th>Nama Mahasiswa</th>
                                <th>IPK</th>
                                <th>Jumlah SKS</th>
                                <th>Tanggal Masuk</th>
                                <th>JK</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $item)
                                <tr>
                                    <td>{{ $item->id_yudisium }}</td>
                                    <td>{{ $item->id_prodi }}</td>  
                                    <td>{{ $item->npm }}</td>
                                    <td>{{ $item->nama_mhs }}</td>
                                    <td>{{ $item->ipk }}</td> 
                                    <td>{{ $item->jml_sks }}</td>
                                    <td>{{ $item->tgl_masuk }}</td>
                                    <td>{{ $item->jk }}</td>             
                                    <td>
                                        <a href="{{ route('detail.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('detail.delete', $item->id) }}" method="POST" style="display: inline-block;">
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
