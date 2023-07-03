@extends('layouts.admin')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Colors
                        <a href="{{ url('admin/colors') }}" class="btn btn-sm btn-primary float-end">
                            BACK
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/colors/'.$color->id) }}" method="post">
                    @csrf
                    @method('put')
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $color->name }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Code</label>
                            <input type="text" name="code" value="{{ $color->code }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Status</label><br>
                            <input type="checkbox" name="status" {{ $color->status == '1' ? 'Checked' : '' }} style="width: 30px; height: 30px;"> Checked = Hidden, UnChecked = Visible
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