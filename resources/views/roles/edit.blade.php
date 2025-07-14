@extends('layouts.app')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Jabatan (Role)</h1>
        </div>

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('roles.update', $role->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $role->name }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>Permission:</strong>
        <br />
        @foreach($permission->sortBy('name') as $value) <!-- Menambahkan sortBy untuk mengurutkan berdasarkan nama -->
        <label>
            <input type="checkbox" name="permission[{{$value->id}}]" value="{{$value->id}}" class="name" 
                {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
            {{ $value->name }}
        </label>
        <br />
        @endforeach
    </div>
</div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </div>
        </div>
    </form>

</div>
@endsection