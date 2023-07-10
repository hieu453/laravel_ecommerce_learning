<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\ProductColor;
use App\Models\Wishlist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $product, $category, $productColorSelectedQuantity, $count = 1, $productColorId;

    public function mount($product, $category) {
        $this->product = $product;
        $this->category = $category;
    }

    public function decrement() {
        if ($this->count >= 1 && $this->count <= 10) {
            $this->count--;
        }
    }

    public function increment() {
        if ($this->count >= 1 && $this->count <= 10) {
            $this->count++;
        }
    }

    public function checkProductColorQuantity() {
        if ($this->productColorSelectedQuantity != null) {
            $productColor = ProductColor::where('id', $this->productColorId)->first();
            if ($productColor->quantity > 0) {
                if ($productColor->quantity > $this->count) {
                    //check cart added or not
                    if (Cart::where([
                        'user_id' => auth()->user()->id,
                        'product_id' => $this->product->id,
                        'product_color_id' => $this->productColorId,
                    ])->exists()) {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Cart already added',
                            'type' => 'success',
                            'status' => 200
                        ]);
                    } else {
                        Cart::create([
                            'user_id' => auth()->user()->id,
                            'product_id' => $this->product->id,
                            'product_color_id' => $this->productColorId,
                            'quantity' => $this->count,
                        ]);
                        $this->emit('cartUpdated');
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Cart added',
                            'type' => 'success',
                            'status' => 200
                        ]);
                    }
                    
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only'.$productColor->quantity.'quantity available',
                        'type' => 'warning',
                        'status' => 409
                    ]);
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Out of stock',
                    'type' => 'warning',
                    'status' => 409
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please select color',
                'type' => 'warning',
                'status' => 401
            ]);
        }   
    }

    public function checkProductQuantity() {
        if ($this->count && ($this->product->quantity > $this->count)) {
            if (Cart::where([
                'user_id' => auth()->user()->id,
                'product_id' => $this->product->id,
                'product_color_id' => $this->productColorId,
            ])->exists()) {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Cart already added',
                    'type' => 'success',
                    'status' => 200
                ]);
            } else {
                Cart::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $this->product->id,
                    'product_color_id' => $this->productColorId,
                    'quantity' => $this->count,
                ]);
                $this->emit('cartUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Cart added',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'please select quantity less than remaining amount',
                'type' => 'warning',
                'status' => 401
            ]);
        }
    }

    public function addToCart($productId) {
        if (Auth::check()) {
            if ($this->product->productColors()->count() > 0) {
                $this->checkProductColorQuantity();
            } else {
                $this->checkProductQuantity();
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please login to add to cart',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }

    public function colorSelected($productColorId) {
        $productColorSelected = $this->product->productColors()->where('id', $productColorId)->first();
        $this->productColorSelectedQuantity = $productColorSelected->quantity;
        $this->productColorId = $productColorId;

        if ($this->productColorSelectedQuantity == 0) {
            $this->productColorSelectedQuantity = 'outOfStock';
        }
    }

    public function addToWishlist($productId) {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already add to wishlish',
                    'type' => 'warning',
                    'status' => 409
                ]);
            } else {    
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId,
                ]);
                $this->emit('updateWishlist');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist added',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please login to add to wishlist',
                'type' => 'info',
                'status' => 401
            ]);
            return false;
        }
    }

    public function render()
    {
        return view('livewire.frontend.product.view');
    }
}
