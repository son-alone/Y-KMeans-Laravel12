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
                    <div class="col-md-12">
                        @can('detail-create')
                        <a href="{{ route('detail.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                        @endcan

                        @can('detail-import')
                        <!-- Trigger the modal -->
                        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#uploadModal">Import Data</button>
                        @endcan
                        <a href="{{ route('detail.template') }}" class="btn btn-primary mb-3">Template Yudisium</a>
                        <form action="{{ route('detail.index') }}" method="GET">
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <select name="provinsi" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinsiList as $provinsi)
                                        <option value="{{ $provinsi->id }}" {{ request('provinsi') == $provinsi->id ? 'selected' : '' }}>
                                            {{ $provinsi->nama_provinsi }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="pt" class="form-control">
                                        <option value="">Pilih Perguruan Tinggi</option>
                                        @foreach ($ptList as $pt)
                                        <option value="{{ $pt->id }}" {{ request('pt') == $pt->id ? 'selected' : '' }}>
                                            {{ $pt->nama_pt }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="prodi" class="form-control">
                                        <option value="">Pilih Program Studi</option>
                                        @foreach ($prodiList as $prodi)
                                        <option value="{{ $prodi->id }}" {{ request('prodi') == $prodi->id ? 'selected' : '' }}>
                                            {{ $prodi->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="batch" class="form-control">
                                        <option value="">Pilih Batch</option>
                                        @foreach ($batchList as $batch)
                                        <option value="{{ $batch->id }}" {{ request('batch') == $batch->id ? 'selected' : '' }}>
                                            {{ $batch->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 text-right">
                                    <input type="text" name="search" class="form-control" placeholder="Cari NPM atau Nama Mahasiswa">
                                </div>
                                <div class="col-md-6 text-left">
                                    <button class="btn btn-primary" type="submit">Filter/Search</button>
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
                            <th>Prodi</th>
                            <th>Jenjang</th>
                            <th>Batch</th>
                            <th>NPM</th>
                            <th>Nama Mahasiswa</th>
                            <th>IPK</th>
                            <th>Jumlah SKS</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Lulus</th>
                            <th>JK</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail as $item)
                        <tr>
                            <td>{{ $item->pt?->provinsi?->nama_provinsi }}</td>
                            <td>{{ $item->pt?->nama_pt }}</td>
                            <td>{{ $item->prodi?->nama }}</td>
                            <td>{{ $item->jenjang }}</td>
                            <td>{{ $item->batch?->nama }}</td>
                            <td>{{ $item->npm }}</td>
                            <td>{{ $item->nama_mhs }}</td>
                            <td>{{ $item->ipk }}</td>
                            <td>{{ $item->jml_sks }}</td>
                            <td>{{ $item->tgl_masuk }}</td>
                            <td>{{ $item->tgl_lulus }}</td>
                            <td>{{ $item->jk }}</td>
                            <td>
                                @can('detail-edit')
                            <a href="{{ route('detail.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                @endcan
                                
                                @can('detail-delete')
                            <form action="{{ route('detail.delete', $item->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Modal for Upload Excel -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Data Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('importExcel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="yudisium_id">Pilih ID Yudisium</label>
                        <select name="yudisium_id" class="form-control" required>
                            <option value="">Pilih ID Yudisium</option>
                            <!-- Loop through the Yudisium IDs -->
                            @foreach ($yudisiumList as $yudisium)
                            <option value="{{ $yudisium->id }}">{{ $yudisium->pt->nama_pt . " batch : " . $yudisium->batch->nama  }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="excelFile">Pilih File Excel</label>
                        <input type="file" name="file" class="form-control" id="excelFile" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<!-- JS Libraries -->

<!-- Page Specific JS File -->
@endpush