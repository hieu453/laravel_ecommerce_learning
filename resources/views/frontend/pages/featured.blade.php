@extends('layouts.app')

@section('title', 'Featured Products')

@section('content')
<div class="pt-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h4>Featured Products</h4>
                <div class="underline"></div>
            </div>
        </div>
    </div>
</div>
<div class="py-5 bg-white">
    <div class="container">
        <div class="row">
            @forelse ($features as $product)
                <div class="col-md-3">
                    <div class="product-card">
                        <div class="product-card-img">
                            <label class="stock bg-danger">New</label>
                            @if ($product->productImages->count() > 0)
                            <a href="{{ url('/collections/'.$product->category->slug.'/'.$product->slug) }}">
                                <img src="{{ asset($product->productImages[0]->image) }}" width="800" height="800" alt="{{ $product->name }}">
                            </a>
                            @endif
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{ $product->brand }}</p>
                            <h5 class="product-name">
                            <a href="{{ url('/collections/'.$product->category->slug.'/'.$product->slug) }}">
                                    {{ $product->name }} 
                            </a>
                            </h5>
                            <div>
                                <span class="selling-price">{{ '$' . number_format($product->selling_price, 0); }}</span>
                                <span class="original-price">{{ '$' . number_format($product->original_price, 0); }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No Products Trendings</h4>
                </div>
            </div>
            @endforelse 
        </div>
    </div>
</div>
@endsection