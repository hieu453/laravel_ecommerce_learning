@extends('layouts.admin')

@section('title', 'Products')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Products
                        <a href="{{ url('admin/products/create') }}" class="btn btn-sm btn-primary float-end">
                            Add Product
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="my-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if ($product->category)
                                        {{ $product->category->name }}
                                    @else
                                        No Category
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->selling_price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                <td>
                                    <a href="{{ url('admin/products/'. $product->id .'/edit') }}" class="btn btn-sm btn-success">Edit</a>
                                    <a onclick="return confirm('Are you sure you want to delete this product?')" href="{{ url('admin/products/'. $product->id .'/delete') }}" class="btn btn-sm btn-danger">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">No Products</td>
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

@section('script')
<script src="cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"></script>
<script src="cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    let table = new DataTable('#my-table', {
        "searching": true,
        
    });

    $('#search-input').on('change', function(){
        table
        .column(3)
        .search(this.value)
        .draw();
    });
</script>
@endsection