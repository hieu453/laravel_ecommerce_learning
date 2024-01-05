@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
			@if (session('message'))
				<h6 class="alert alert-success">{{ session('message') }}</h6>
			@endif
			<div class="me-md-3 me-xl-5">
				<h2>Dashboard</h2>				
				<p class="mb-md-0">Your Analytics Dashboard Template</p>
			</div>  

			<div class="row">
				<div class="col-md-3">
					<div class="card card-body bg-primary text-white mb-3">
						<label>Total Orders</label>
						<h1>{{ $totalOrders }}</h1>
						<a href="{{ url('admin/orders') }}" class="text-white">View</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card card-body bg-danger text-white mb-3">
						<label>Total Products</label>
						<h1>{{ $totalProducts }}</h1>
						<a href="{{ url('admin/products') }}" class="text-white">View</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card card-body bg-success text-white mb-3">
						<label>Total Users</label>
						<h1>{{ $totalUsers }}</h1>
						<a href="{{ url('admin/users') }}" class="text-white">View</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card card-body bg-warning text-white mb-3">
						<label>Total Admin</label>
						<h1>{{ $totalAdmin }}</h1>
						<a href="{{ url('admin/users') }}" class="text-white">View</a>
					</div>
				</div>
			</div>
      	</div>
    </div>
</div>
@endsection