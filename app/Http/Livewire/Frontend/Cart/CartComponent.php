<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public $carts, $totalPrice = 0;

    public function incrementQuantity($cartId) {
        $cartData = Cart::where([
            'id' => $cartId,
            'user_id' => auth()->user()->id
        ])->first();
        $cartData->increment('quantity');

    }

    public function decrementQuantity($cartId) {
        $cartData = Cart::where([
            'id' => $cartId,
            'user_id' => auth()->user()->id
        ])->first();
        $cartData->decrement('quantity');
    }

    public function removeCartItem($cartId) {
        Cart::where([
            'id' => $cartId,
            'user_id' => auth()->user()->id,
        ])->delete();
        $this->dispatchBrowserEvent('message', [
            'text' => 'Cart deleted',
            'type' => 'success',
            'status' => 200
        ]);
        $this->emit('cartUpdated');
    }

    public function render()
    {
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-component', [
            'carts' => $this->carts,
        ]);
    }
}
