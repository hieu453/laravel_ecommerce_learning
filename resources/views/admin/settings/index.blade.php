@extends('layouts.admin')

@section('title', 'Admin Settings')

@section('content')
@if (session('message'))
<div class="alert alert-success">{{ session('message') }}</div>
@endif
<div class="row">
    <div class="col-md-12 grid-margin">
        <form action="{{ url('/admin/settings') }}" method="post">
            @csrf
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Website name</label>
                        <input type="text" name="website_name" class="form-control"/>
                        {{-- @error('name') <small class="text-danger">{{ $message }}</small> @enderror --}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Website URL</label>
                        <input type="text" name="website_url" class="form-control"/>
                        {{-- @error('slug') <small class="text-danger">{{ $message }}</small> @enderror --}}
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Page Title</label>
                        <input type="text" name="page_title" class="form-control"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Meta Keyword</label>
                        <textarea name="meta_keyword" class="form-control"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website Information</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control"/>
                        {{-- @error('slug') <small class="text-danger">{{ $message }}</small> @enderror --}}
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website Social-media</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Facebook</label>
                        <input type="text" name="facebook" class="form-control"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Twitter</label>
                        <input type="text" name="twitter" class="form-control"/>
                        {{-- @error('slug') <small class="text-danger">{{ $message }}</small> @enderror --}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Instagram</label>
                        <input type="text" name="instagram" class="form-control"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Youtube</label>
                        <input type="text" name="youtube" class="form-control"/>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary float-end">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection