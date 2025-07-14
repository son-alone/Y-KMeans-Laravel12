@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pengguna (Users)</h1>
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
                        @can('users-create')
                <a class="btn btn-success mb-3" href="{{ route('user.create') }}"><i class="fa fa-plus"></i> Create New Role</a>
                @endcan
                    </div>
                </div>

<table class="table table-bordered">
   <thead>
<tr>
       <th>No</th>
       <th>Name</th>
       <th>Email</th>
       <th>Roles</th>
       <th>Action</th>
   </tr>
</thead>
   @foreach ($data as $key => $user)
    <tbody>
   <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
               <label class="badge bg-success">{{ $v }}</label>
            @endforeach
          @endif
        </td>
        <td>
             <a class="btn btn-info" href="{{ route('users.show',$user->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                @can('user-edit')
             <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                @endcan
                @can('user-delete')
             <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
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

{!! $data->links('pagination::bootstrap-5') !!}

@endsection