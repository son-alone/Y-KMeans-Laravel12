@extends('layouts.app')

@section('title', 'Data PT')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data PT</h1>
            </div>
            <form action="{{ route('pt.update', $pt->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_pt">Nama PT</label>
                    <input type="text" name="nama_pt" id="nama_pt" class="form-control" value="{{ $pt->nama_pt }}" maxlength="255" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="number" name="no_hp" id="no_hp" class="form-control" value="{{ $pt->no_hp }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $pt->email }}" maxlength="255" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $pt->alamat }}" maxlength="255" required>
                </div>

                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="text" name="logo" id="logo" class="form-control" value="{{ $pt->logo }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </section>
    </div>
@endsection
