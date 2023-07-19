<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
    public $carts;
    public $totalAmount;
    public $fullname, $phone, $email, $pincode, $address, $payment_mode, $payment_id = null;

    protected $rules = [
        'fullname' => 'required|string|min:4|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|min:10|max:11',
        'pincode' => 'required|string|max:6|min:6',
        'address' => 'required|string|max:500',
    ];

    protected $messages = [
        'fullname.required' => 'Điền tên vào tml',
        'fullname.min' => 'Tên ngắn quá',
        'email.required' => 'Điền Email vào tml.',
        'email.email' => 'Email không hợp lệ nhé tml.',
    ];

    public function updated($fullname)
    {
        $this->validateOnly($fullname);
    }

    public function placeOrder() {
        $this->validate();

        $order = Order::create([
            'user_id' => auth()->user()->id, 
            'tracking_no' => 'no'.Str::random(10),
            'fullname' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,       
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);

        foreach ($this->carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'product_color_id' => $cart->product_color_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->selling_price,
            ]);

            if ($cart->product_color_id != null) {
                $cart->productColor()->where('id', $cart->product_color_id)->decrement('quantity', $cart->quantity);
                $cart->product()->where('id', $cart->product_id)->decrement('quantity', $cart->quantity);
            } else {
                $cart->product()->where('id', $cart->product_id)->decrement('quantity', $cart->quantity);
            }
        }

    }

    public function codOrder() {
        $this->payment_mode = 'COD';
      
        $this->placeOrder();
        Cart::where('user_id', auth()->user()->id)->delete();
        $this->emit('cartUpdated');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Đặt hàng thành công',
            'type' => 'success',
            'status' => 200
        ]);
        return redirect()->to('/thank-you');
    }

    public function itemTotalAmount() {
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->carts as $cart) {
            $this->totalAmount += $cart->product->selling_price * $cart->quantity;
        }
    }

    public function render()
    {
        $this->totalAmount = 0;
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->itemTotalAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalAmount' => $this->totalAmount,
        ]);
    }
}
