<div>
    <div class="py-3 py-md-5">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        {{-- @if (count($product->productImages) === 0)
                            No Image
                        @else
                            <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img">  
                        @endif --}}
                        <div class="exzoom" id="exzoom">
                            <!-- Images -->
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    @foreach ($product->productImages as $productImage)
                                        <li><img src="{{ asset($productImage->image) }}" class="w-100" alt="Img"/></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- <a href="https://www.jqueryscript.net/tags.php?/Thumbnail/">Thumbnail</a> Nav-->
                            <div class="exzoom_nav"></div>
                                <!-- Nav Buttons -->
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}
                            {{-- @if ($product->quantity)
                                <label class="label-stock bg-success">In Stock</label>
                            @else
                                <label class="label-stock bg-danger">Out Of Stock</label>
                            @endif --}}
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $product->category->name }} / {{ $product->name }}
                        </p>
                        <div>
                            <span class="selling-price">${{ $product->selling_price }}</span>
                            <span class="original-price">${{ $product->original_price }}</span>
                        </div>
                        <div>
                            @if (count($product->productColors) > 0)
                                @foreach ($product->productColors as $colorItem)
                                    {{-- <input type="radio" name="colorSelection" value="{{ $colorItem->id }}"> {{ $colorItem->color->name }} --}}
                                    <label class="color-selection-label" style="background-color: {{ $colorItem->color->code }};"
                                        wire:click="colorSelected({{ $colorItem->id }})">
                                        {{ $colorItem->color->name }}
                                    </label>
                                @endforeach
                            <div class="mt-3"></div>
                                @if ($this->productColorSelectedQuantity == 'outOfStock')
                                    <label class="label-stock bg-danger">Out Of Stock</label>
                                @elseif($this->productColorSelectedQuantity > 0)
                                    <label class="label-stock bg-success">In Stock</label>
                                @endif
                            </div>
                            @else
                                @if ($product->quantity)
                                    <label class="label-stock bg-success">In Stock</label>
                                @else
                                    <label class="label-stock bg-danger">Out Of Stock</label>
                                @endif
                            @endif
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrement"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="count" value="{{ $this->count }}" class="input-quantity" />
                                <span class="btn btn1" wire:click="increment"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button wire:click="addToCart({{ $product->id }})" class="btn btn1"> <i class="fa fa-shopping-cart"></i>
                                 Add To Cart
                            </button>
                            <button href="" class="btn btn1" wire:click="addToWishlist({{ $product->id }})"> <i class="fa fa-heart">
                                </i> Add To Wishlist 
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {{ $product->small_description }}                                
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Related Products</h3>
                    <div class="underline"></div>
                </div>

                @forelse ($category->products as $product)
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
</div>

@section('script')
    <script>
        $(function(){
            $("#exzoom").exzoom({
                // thumbnail nav options
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,

                // autoplay
                "autoPlay": true,

                // autoplay interval in milliseconds
                "autoPlayTimeout": 2000
            });
        });
    </script>
@endsection