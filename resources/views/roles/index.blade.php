@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Role Management</h1>
        </div>

@session('success')
    <div class="alert alert-success" role="alert">
        {{ $value }}
    </div>
@endsession

        <div class="section-body">
            <div class="table-responsive">
                <div class="row mb-3">
                    <div class="col-md-6">
                        @can('role-create')
                <a class="btn btn-success mb-3" href="{{ route('roles.create') }}"><i class="fa fa-plus"></i> Create New Role</a>
                @endcan
                    </div>
                </div>


    <table class="table table-bordered">
    <thead>
    <tr>
            <th>No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
        @foreach ($roles as $key => $role)
        <tbody>
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $role->name }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                @endcan

                @can('role-delete')
                <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>

    {!! $roles->links('pagination::bootstrap-5') !!}


</div>
@endsection