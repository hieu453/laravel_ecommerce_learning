@extends('layouts.admin')

@section('title', 'Create User')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Add User
                    <a href="{{ url('admin/users') }}" class="btn btn-sm btn-primary float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/users') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"/>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"/>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control"/>
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                            </select>
                            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <button type="submit" class="btn btn-primary float-end">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection