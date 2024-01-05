@extends('layouts.admin')

@section('title', 'Users list')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Users
                        <a href="{{ url('admin/users/create') }}" class="btn btn-sm btn-primary float-end">
                            Add Users
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role_as == '1')
                                        <label class="badge btn btn-primary">Admin</label>    
                                    @else
                                        <label class="badge btn btn-success">User</label>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/users/'. $user->id .'/edit') }}" class="btn btn-sm btn-success">Edit</a>
                                    <a onclick="return confirm('Are you sure you want to delete this user?')" href="{{ url('admin/users/'. $user->id .'/delete') }}" class="btn btn-sm btn-danger">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Users</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection