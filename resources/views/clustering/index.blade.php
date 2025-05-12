@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Clustering Mahasiswa Berdasarkan Provinsi</h1>
        
        <div class="list-group">
            @foreach($provinsi as $prov)
                <a href="{{ route('clustering.cluster', $prov->id) }}" class="list-group-item list-group-item-action">
                    {{ $prov->nama }}
                </a>
            @endforeach
        </div>
    </div>
@endsection
