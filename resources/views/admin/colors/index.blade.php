@extends('layouts.admin')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Color List
                        <a href="{{ url('admin/colors/create') }}" class="btn btn-sm btn-primary float-end">
                            Add Color
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colors as $color)
                            <tr>
                                <td>{{ $color->id }}</td>
                                <td>{{ $color->name }}</td>
                                <td>{{ $color->code }}</td>
                                <td>{{ $color->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                <td>
                                    <a href="{{ url('admin/colors/'. $color->id .'/edit') }}" class="btn btn-success">Edit</a>
                                    <a href="{{ url('admin/colors/'. $color->id .'/delete') }}" onclick="return confirm('Are you sure you want to delete this data')" class="btn btn-danger">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection