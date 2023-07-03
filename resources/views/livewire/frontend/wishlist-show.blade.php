<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
    
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($wishlists as $wishlist)
                            @if ($wishlist->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a href="{{ url('/collections/'.$wishlist->product->category->name.'/'.$wishlist->product->slug) }}">
                                                <label class="product-name">
                                                    @if ($wishlist->product->productImages->count() > 0)
                                                        <img src="{{ $wishlist->product->productImages[0]->image }}" style="width: 50px; height: 50px" alt="">
                                                    @else
                                                        (No image)
                                                    @endif
                                                    {{ $wishlist->product->name }}
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">$569 </label>
                                        </div>
                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <button class="btn btn-danger btn-sm" wire:click="removeWishlistItem({{ $wishlist->id }})">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            No Wishlist Added
                        @endforelse
                      
                                
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
