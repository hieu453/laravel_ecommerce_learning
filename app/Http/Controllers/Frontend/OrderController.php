<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('frontend.orders.index', compact('orders'));
    }

    public function show($orderId) {
        $order = Order::where('id', $orderId)->first();
        return view('frontend.orders.show', compact('order'));
    }
}
