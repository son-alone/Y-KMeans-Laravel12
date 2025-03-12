@extends('layouts.app')

@section('title', 'Tambah Data PT Prodi')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data PT Prodi</h1>
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
            <form action="{{ route('ptprodi.store') }}" method="POST">
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
                            @foreach ($data_prodi as $pt)
                                <option value="{{ $pt->id }}">{{ $pt->nama }}</option>
                            @endforeach   
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenjang">Jenjang</label>
                        <input type="text" name="jenjang" id="jenjang" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="akreditasi">Akreditasi</label>
                        <input type="text" name="akreditasi" id="akreditasi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sk">SK</label>
                        <input type="text" name="sk" id="sk" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_berlaku">Tgl Berlaku</label>
                        <input type="date" name="tanggal_berlaku" id="tanggal_berlaku" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="jumlah_dosen">Jml Dosen</label>
                        <input type="text" name="jumlah_dosen" id="jumlah_dosen" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_mahasiswa">Jml Mhs</label>
                        <input type="text" name="jumlah_mahasiswa" id="jumlah_mahasiswa" class="form-control">
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
