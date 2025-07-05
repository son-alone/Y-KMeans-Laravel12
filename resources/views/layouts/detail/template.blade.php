@extends('layouts.app')

@section('title', 'Template Data')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Template Data</h1>
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Template File Mahasiswa Yudisium</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>
                                            <a href="{{ "http://127.0.0.1:8000/tempublic/template.xlsx" }}" target="_blank">Unduh File</a>
                                    </td>
                                </tr>
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
