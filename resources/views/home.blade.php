@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>LLDIKTI Wilayah 2 Dashboard</h2>
    <div class="row mt-4">
        <!-- Statistik Kartu -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4>Total Perguruan Tinggi</h4>
                    <p>{{ $totalUniversitas }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4>Total Program Studi</h4>
                    <p>{{ $totalProgramStudi }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4>Total Mahasiswa</h4>
                    <p>{{ $totalMahasiswa }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4>Total Dosen</h4>
                    <p>{{ $totalDosen }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <!-- Grafik -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>Grafik Jumlah Perguruan Tinggi per Provinsi</h4>
                    <canvas id="chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('chart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($universitas),  // Data universitas
            datasets: [{
                label: 'Jumlah Perguruan Tinggi',
                data: @json($jumlahMahasiswa),  // Data jumlah mahasiswa
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
