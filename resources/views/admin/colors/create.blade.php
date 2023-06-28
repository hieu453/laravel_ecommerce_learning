@extends('layouts.admin')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Colors
                        <a href="{{ url('admin/colors') }}" class="btn btn-sm btn-primary float-end">
                            BACK
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/colors/create') }}" method="post">
                    @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Code</label>
                            <input type="text" name="code" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Status</label><br>
                            <input type="checkbox" name="status" style="width: 30px; height: 30px;"> Checked = Hidden, UnChecked = Visible
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-end">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection