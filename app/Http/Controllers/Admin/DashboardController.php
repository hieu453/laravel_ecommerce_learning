<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalUsers = User::where('role_as', 0)->count();
        $totalAdmin = User::where('role_as', 1)->count();

        return view('admin.dashboard', compact('totalOrders', 'totalProducts', 'totalUsers', 'totalAdmin'));
    }
}
