@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="shadow bg-white p-3">
                <h4 class="text-primary">
                    <i class="fa fa-shopping-cart text-dark">My Order Details</i>
                    <a href="{{ url('orders/') }}" class="btn btn-primary btn-sm float-end">Back</a>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Order Details</h5>
                        <hr>
                        <h6>Order Id: {{ $order->id }}</h6>
                        <h6>Tracking No: {{ $order->tracking_no }}</h6>
                        <h6>Ordered date: {{ $order->created_at->format('d-m-Y') }}</h6>
                        <h6>Payment mode: {{ $order->payment_mode }}</h6>
                        <h6 class="border p-2 text-success">
                            Order status message: <span class="text-uppercase">in progress</span>
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <h5>User Details</h5>
                        <hr>
                        <h6>Fullname: {{ $order->fullname }}</h6>
                        <h6>Email: {{ $order->email }}</h6>
                        <h6>Phone: {{ $order->phone }}</h6>
                        <h6>Pincode: {{ $order->pincode }}</h6>
                    </div>
                </div>
                <br>
                <h5>Order Item</h5>
                <hr>
                <div class="talbe-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>Item ID</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;   
                            @endphp
                            @forelse ($order->orderItems as $orderItem)
                                <tr>
                                    <td>{{ $orderItem->id }}</td>
                                    <td>
                                        @if ($orderItem->product->productImages)
                                            <img src="{{ asset($orderItem->product->productImages[0]->image) }}" alt="image">
                                        @else
                                            <img src="" alt="">    
                                        @endif
                                    </td>
                                    <td>
                                        {{ $orderItem->product->name }}
                                        @if ($orderItem->productColor)
                                            @if ($orderItem->productColor->color)
                                                <span>-Color: {{ $orderItem->productColor->color->name }}</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $orderItem->price }}</td>
                                    <td>{{ $orderItem->quantity }}</td>
                                    <td class="fw-bold">{{ $orderItem->price * $orderItem->quantity }}$</td>
                                    {{ $total += $orderItem->price * $orderItem->quantity }}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No Item</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="5" class="fw-bold">Total price: </td>
                                <td colspan="1" class="fw-bold">{{ $total }}$</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection