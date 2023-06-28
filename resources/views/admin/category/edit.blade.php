@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Category
                    <a href="{{ url('admin/category') }}" class="btn btn-sm btn-primary float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/category/'.$category->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ $category->name }}" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Slug</label>
                            <input type="text" name="slug" value="{{ $category->slug }}" class="form-control"/>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control"/>
                            <img src="{{ asset('uploads/category/'.$category->image) }}" alt="" width="100" height="100">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Status</label><br/>
                            <input type="checkbox" name="status" value="{{ $category->slug == '1' ? 'checked' : '' }}" />
                        </div>
                        <div class="md-12">
                            <h4>SEO Tags</h4>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ $category->meta_title }}"/>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Meta Keyword</label>
                            <textarea name="meta_keyword" class="form-control" rows="3">{{ $category->meta_keyword }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3">{{ $category->meta_description }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <button type="submit" class="btn btn-primary float-end">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection