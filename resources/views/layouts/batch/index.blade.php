@extends('layouts.app')

@section('title', 'Batch')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Batch</h1>
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
                        @can('batch-create')
                        <a href="{{ route('batch.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                        @endcan
                            <form action="{{ route('batch.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari Berdasarkan Batch">
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
                                <th>Nama</th>
                                <th>Range Awal</th>
                                <th>Range Akhir</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batch as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->range_awal }}</td>  
                                    <td>{{ $item->range_akhir }}</td>            
                                    <td>
                                    @can('batch-edit')
                                    <a href="{{ route('batch.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                    @endcan
                                    @can('batch-delete')
                                    <form action="{{ route('batch.delete', $item->id) }}" method="POST" style="display: inline-block;">
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
