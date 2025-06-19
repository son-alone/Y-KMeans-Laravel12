@extends('layouts.app')

@section('title', 'Hasil Clustering Mahasiswa')



@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Hasil Clustering Mahasiswa</h1>
        </div>

        <div class="section-body">
            @if(isset($centroids) && isset($clusters))
            <div class="card">
                <div class="card-header">
                    <h4>Centroids (Titik Pusat Cluster)</h4>
                </div>
                <div class="card-body">
                    <table id="centroidsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>IPK</th>
                                <th>Jumlah SKS</th>
                                <th>Waktu Kuliah (Tahun)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($centroids as $index => $centroid)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ number_format($centroid[4], 2) }}</td>
                                <td>{{ round($centroid[5]) }}</td>
                                <td>{{ round($centroid[6], 1) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4>Clusters (Hasil Pengelompokan)</h4>
                </div>
                <div class="card-body">
                    @foreach($clusters as $index => $cluster)
                    <div class="mb-4">
                        <h5>Cluster {{ $index + 1 }}</h5>
                        <table id="clusterTable{{ $index }}" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Perguruan Tinggi</th>
                                    <th>NPM/Mahasiswa</th>
                                    <th>IPK</th>
                                    <th>Jumlah SKS</th>
                                    <th>Waktu Kuliah (Tahun)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cluster as $member)
                                <tr>
                                    <td>{{ $member[9] }}</td>
                                    <td>{{ str($member[7]). " ". $member[8] }}</td>
                                    <td>{{ number_format($member[4], 2) }}</td>
                                    <td>{{ round($member[5]) }}</td>
                                    <td>{{ round($member[6],1) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="alert alert-danger">
                Data clustering tidak ditemukan.
            </div>
            @endif
        </div>
    </section>
</div>


<script>
    $(document).ready(function() {
        $('#centroidsTable').DataTable(); // Inisialisasi DataTables untuk centroids
        @foreach($clusters as $index => $cluster)
        $('#clusterTable{{ $index }}').DataTable(); // Inisialisasi DataTables untuk setiap cluster
        @endforeach
    });
</script>
@endsection