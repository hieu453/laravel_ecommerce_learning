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
                    <h3>Slider List
                        <a href="{{ url('admin/sliders/create') }}" class="btn btn-sm btn-primary float-end">
                            Add Slider
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td>{{ $slider->title }}</td>
                                <td>
                                    <img src="{{ asset($slider->image) }}" alt="slider" style="width: 70px; height: 70px;">
                                </td>
                                <td>{{ $slider->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                <td>
                                    <a href="{{ url('admin/sliders/'. $slider->id .'/edit') }}" class="btn btn-success">Edit</a>
                                    <a href="{{ url('admin/sliders/'. $slider->id .'/delete') }}" onclick="return confirm('Are you sure you want to delete this data')" class="btn btn-danger">
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