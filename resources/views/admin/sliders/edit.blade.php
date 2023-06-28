@extends('layouts.admin')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Slider
                        <a href="{{ url('admin/sliders') }}" class="btn btn-sm btn-primary float-end">
                            BACK
                        </a>
                    </h3>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/sliders/'.$slider->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ $slider->title }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $slider->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                            <img src="{{ asset($slider->image) }}" alt="slider">
                        </div>
                        <div class="mb-3">
                            <label>Status</label><br>
                            <input type="checkbox" name="status" {{ $slider->status == '1' ? 'Checked' : '' }} style="width: 30px; height: 30px;"> Checked = Hidden, UnChecked = Visible
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-end">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection