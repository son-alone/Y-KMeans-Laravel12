@extends('layouts.app')

@section('title', 'Yudisium')

@push('style')
<!-- Custom CSS for Modal -->
<style>
    /* Modal Container */
    .custom-modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Dark background */
        padding-top: 60px;
    }

    /* Modal Content */
    .custom-modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 900px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    /* Modal Header */
    .custom-modal-header {
        background-color: #007bff;
        color: white;
        padding: 15px;
        border-radius: 10px 10px 0 0;
        font-size: 1.5rem;
        text-align: center;
    }

    /* Modal Body */
    .custom-modal-body {
        padding: 20px;
    }

    /* Close Button */
    .custom-close {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        top: 10px;
        right: 15px;
    }

    .custom-close:hover,
    .custom-close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* PDF Viewer */
    .custom-pdf-viewer {
        width: 100%;
        height: 500px;
        border-radius: 8px;
    }
</style>
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
                        @can('pt-create')
                        <a href="{{ route('yudisium.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                        @endcan
                        <form action="{{ route('yudisium.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari Berdasarkan Tanggal Yudisium">
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
                            <td><a href="{{ asset('storage/' . trim($item->file)) }}" class="btn btn-info" target="_blank">
                                    Download File PDF
                                </a>
                            </td>
                            <td><?php
                                $utcTime = $item->tanggal_verifikasi; // Misalnya waktu dalam UTC dari database
                                $localTime = \Carbon\Carbon::parse($utcTime)->timezone('Asia/Jakarta');
                                echo $localTime;
                                ?></td>
                            <td>{{ $item->Verifikator?->name }}</td>
                            <td>
                              @can('yudisium-verifikasi')  
                            <a href="{{ route('verifikasi', $item->id) }}" class="btn btn-danger">Verifikasi</a>
                                @endcan
                            @can('yudisium-edit')
                            <a href="{{ route('yudisium.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                            @endcan    
                            @can('yudisium-delete')
                            <form action="{{ route('yudisium.delete', $item->id) }}" method="POST" style="display: inline-block;">
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

<!-- Custom Modal Structure -->
<!-- <div id="customModal" class="custom-modal">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <span class="custom-close" onclick="closeModal()">&times;</span>
            Lihat PDF
        </div>
        <div class="custom-modal-body">
            <embed id="customPdfViewer" src="" class="custom-pdf-viewer" type="application/pdf">
        </div>
    </div>
</div> -->

<script>
    // Open the modal and set the PDF URL
    function openModal(fileUrl) {
        document.getElementById('customModal').style.display = 'block';
        document.getElementById('customPdfViewer').setAttribute('src', fileUrl);
    }

    // Close the modal
    function closeModal() {
        document.getElementById('customModal').style.display = 'none';
        document.getElementById('customPdfViewer').setAttribute('src', ''); // Reset the PDF source
    }

    // Close the modal if clicked outside of it
    window.onclick = function(event) {
        var modal = document.getElementById('customModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>

@endsection

@push('scripts')
<!-- JS Libraries -->
@endpush