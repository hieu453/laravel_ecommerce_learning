<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $product, $category, $productColorSelectedQuantity, $count = 1;

    public function mount($product, $category) {
        $this->product = $product;
        $this->category = $category;
    }

    public function decrement() {
        if ($this->count > 1) {
            $this->count--;
        }
    }

    public function increment() {
        if ($this->count < 10) {
            $this->count++;
        }
    }

    public function colorSelected($productColorId) {
        $productColorSelected = $this->product->productColors()->where('id', $productColorId)->first();
        $this->productColorSelectedQuantity = $productColorSelected->quantity;

        if ($this->productColorSelectedQuantity == 0) {
            $this->productColorSelectedQuantity = 'outOfStock';
        }
    }

    public function addToWishlist($productId) {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already add to wishlish',
                    'type' => 'success',
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
