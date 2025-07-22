@extends('layouts.app')

@section('title', 'Yudisium')

@push('style')
<!-- Custom CSS for Modal -->
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
                        @can('yudisium-create')
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
                            <th>Batch</th>
                            <th>Perguruan Tinggi</th>
                            <th>Tanggal Yudisium</th>
                            <th>File</th>
                            <th>Tanggal Verifikasi</th>
                            <th>Verifikator</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php use Illuminate\Support\Facades\Storage; @endphp
                        @foreach ($yudisium as $item)
                        <tr>
                            <td>{{ $item->batch?->nama }}</td>
                            <td>{{ $item->pt?->nama_pt }}</td>
                            <td>{{ $item->tanggal_yudisium }}</td>
                            <td>
    @php
        $filePath = trim($item->file);
    @endphp

    @if ($filePath && Storage::disk('public')->exists($filePath))
        @can('yudisium-download')
        <a href="{{ asset('storage/' . $filePath) }}" class="btn btn-info" target="_blank">
            Download File PDF
        </a>
        @endcan
    @else
        <span class="text-danger">File tidak ditemukan</span>
    @endif
</td>
                            <td><?php
                                if ($item->tanggal_verifikasi) {
                                    $utcTime = $item->tanggal_verifikasi; // Misalnya waktu dalam UTC dari database
                                    $localTime = \Carbon\Carbon::parse($utcTime)->timezone('Asia/Jakarta');
                                    echo $localTime;
                                }
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