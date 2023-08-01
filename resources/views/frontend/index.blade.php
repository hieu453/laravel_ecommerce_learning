@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($sliders as $key => $slider)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            @if ($slider->image)
            <img src="{{ asset($slider->image) }}" class="d-block w-100" alt="..." width="1200" height="400">
            @endif
        </div>

        <div class="carousel-caption d-none d-md-block">
            <div class="custom-carousel-content">
                <h1>{!! $slider->title !!}</h1>
                <p>{!! $slider->description !!}</p>
                <div>
                    <a href="#" class="btn btn-slider">
                        Get Now
                    </a>
                </div>
            </div>
        </div>
        @endforeach 
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

    <div class="py-5 bg-white">
        <div class="container">
            {{-- <div class="row justify-content-center"> --}}
                    <div class="owl-carousel owl-theme">
                        @forelse ($trendingProducts as $product)
                                <div class="item">
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
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    pagination:true,
    autoplay:true,
    autoplayTimeout:2000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
</script>
@endsection