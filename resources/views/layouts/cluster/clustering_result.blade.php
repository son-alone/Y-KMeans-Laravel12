@extends('layouts.app')

@section('title', 'Hasil Clustering Mahasiswa')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="text-dark">Hasil Clustering Mahasiswa</h1>
        </div>

        <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow">
                    <div class="card-body p-3">
                        <canvas id="ipkChart" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow">
                    <div class="card-body p-3">
                        <canvas id="sksChart" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow">
                    <div class="card-body p-3">
                        <canvas id="waktuKuliahChart" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow">
                    <div class="card-body p-3">
                        <canvas id="jumlahDataPerClusterChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Script Chart --}}
        <script>
            var ipkData = @json($centroids);
            console.log(ipkData);
            var ipkLabels = ipkData.map(function(centroid, index) {
                return 'Centroid ' + (index + 1);
            });

            var ipkValues = ipkData.map(function(centroid) {
                return Math.round(centroid[4] * 100) / 100;
            });

            var ctx = document.getElementById('ipkChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ipkLabels,
                    datasets: [{
                        label: 'IPK',
                        data: ipkValues,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: { y: { beginAtZero: true } }
                }
            });
        </script>

        <script>
            var sksValues = ipkData.map(function(centroid) {
                return centroid[5];
            });

            var ctx = document.getElementById('sksChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ipkLabels,
                    datasets: [{
                        label: 'Jumlah SKS',
                        data: sksValues,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: { y: { beginAtZero: true } }
                }
            });
        </script>

        <script>
            var waktuKuliahValues = ipkData.map(function(centroid) {
                return Math.round(centroid[6] * 10) / 10;
            });

            var ctx = document.getElementById('waktuKuliahChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ipkLabels,
                    datasets: [{
                        label: 'Waktu Kuliah (Tahun)',
                        data: waktuKuliahValues,
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: { y: { beginAtZero: true } }
                }
            });
        </script>

        <script>
            var clusters = @json($clusters);
            var clusterCounts = clusters.map(function(cluster) {
                return cluster.length;
            });

            var ctx = document.getElementById('jumlahDataPerClusterChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ipkLabels,
                    datasets: [{
                        label: 'Jumlah Data per Cluster',
                        data: clusterCounts,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: { y: { beginAtZero: true } }
                }
            });
        </script>

        <div class="section-body">
            @if(isset($centroids) && isset($clusters))
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-dark">Centroids (Titik Pusat Cluster)</h4>
                </div>
                <div class="card-body table-responsive">
                    <table id="centroidsTable" class="table table-striped table-bordered table-hover">
                        <thead class="bg-light">
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

            <div class="card shadow mt-4">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0 text-dark">Clusters (Hasil Pengelompokan)</h4>
                </div>
                <div class="card-body">
                    @foreach($clusters as $index => $cluster)
                    <div class="mb-4">
                        <h5 class="text-dark">Cluster {{ $index + 1 }}</h5>
                        <div class="table-responsive">
                            <table id="clusterTable{{ $index }}" class="table table-striped table-bordered table-hover">
                                <thead class="bg-light">
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
                                        <td>{{ str($member[7]) . " " . $member[8] }}</td>
                                        <td>{{ number_format($member[4], 2) }}</td>
                                        <td>{{ round($member[5]) }}</td>
                                        <td>{{ round($member[6],1) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="alert alert-warning">
                Data clustering tidak ditemukan.
            </div>
            @endif
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        $('#centroidsTable').DataTable();
        @foreach($clusters as $index => $cluster)
        $('#clusterTable{{ $index }}').DataTable();
        @endforeach
    });
</script>
@endsection
