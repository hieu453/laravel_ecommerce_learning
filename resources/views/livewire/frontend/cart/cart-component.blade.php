<div>
    <div class="py-3 py-md-5">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Total Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse ($carts as $cart)
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-6 my-auto">
                                        <a href="{{ url('/collections/'.$cart->product->category->slug.'/'.$cart->product->slug) }}">
                                            <label class="product-name">
                                                @if ($cart->product->productImages->count() > 0)
                                                    <img src="{{ asset($cart->product->productImages[0]->image) }}" style="width: 50px; height: 50px" alt="">
                                                @endif
                                                {{ $cart->product->name }}
                                                @if ($cart->productColor)
                                                    <span>with color: {{ $cart->productColor->color->name }}</span>
                                                @endif
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-1 my-auto">
                                        <label class="price">{{ $cart->product->selling_price }}$</label>
                                    </div>
                                    <div class="col-md-2 col-7 my-auto">
                                        <div class="quantity">
                                            <div class="input-group">
                                                <button class="btn btn1" wire:click="decrementQuantity({{ $cart->id }})"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="{{ $cart->quantity }}" class="input-quantity" />
                                                <button class="btn btn1" wire:click="incrementQuantity({{ $cart->id }})"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 my-auto">
                                        <label class="price">{{ $cart->product->selling_price * $cart->quantity }}$</label>
                                        @php
                                            $totalPrice += $cart->product->selling_price * $cart->quantity
                                        @endphp
                                    </div>
                                    <div class="col-md-2 col-5 my-auto">
                                        <div class="remove">
                                            <button wire:click="removeCartItem({{ $cart->id }})" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            No Cart Item
                        @endforelse  
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h4><a href="{{ url('/collections') }}">Shop now</a></h4>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3">
                        <h4>Total: 
                            <span class="float-end">{{ $totalPrice }}$</span>
                        </h4>
                    </div>
                    <hr>
                    <a href="{{ url('/checkout') }}" class="btn btn-warning w-100">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
