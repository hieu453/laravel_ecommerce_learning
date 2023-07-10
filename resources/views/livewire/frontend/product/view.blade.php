<div>
    <div class="py-3 py-md-5">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border">
                        @if (count($product->productImages) === 0)
                            No Image
                        @else
                            <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img">  
                        @endif
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
</div>
