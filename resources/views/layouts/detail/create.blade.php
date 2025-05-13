@extends('layouts.app')

@section('title', 'Tambah Data Detail Yudisium')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Detail Yudisium</h1>
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
            <form action="{{ route('detail.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_pt">ID PT</label>
                    <select name="id_pt" id="id_pt">
                        @foreach ($data_pt as $pt)
                        <option value="{{ $pt->id }}">{{ $pt->nama_pt }}</option>
                        @endforeach
                    </select>
                </div>

                    <div class="form-group">
                    <label for="id_prodi">ID Prodi</label>
                    <select name="id_prodi" id="id_prodi">
                        @foreach ($data_prodi as $prodi)
                        <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="npm">npm</label>
                        <input type="text" name="npm" id="npm" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_mhs">nama_mhs</label>
                        <input type="text" name="nama_mhs" id="nama_mhs" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ipk">ipk</label>
                        <input type="double" name="ipk" id="ipk" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jml_sks">jml_sks</label>
                        <input type="number" name="jml_sks" id="jml_sks" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tgl_masuk">tgl_masuk</label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jk">jk</label>
                        <input type="text" name="jk" id="jk" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->

    <!-- Page Specific JS File -->
@endpush
