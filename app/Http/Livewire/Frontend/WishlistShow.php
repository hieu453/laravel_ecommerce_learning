<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;

class WishlistShow extends Component
{
    public function removeWishlistItem($wishlistId) {
        Wishlist::where('id', $wishlistId)->where('user_id', auth()->user()->id)->delete();
        $this->emit('updateWishlist');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Wishlist deleted',
            'type' => 'success',
            'status' => 200
        ]);
    }

    public function render()
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show', [
            'wishlists' => $wishlists,
        ]); 
    }
}
