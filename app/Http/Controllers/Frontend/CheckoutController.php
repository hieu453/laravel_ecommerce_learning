<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()  {
        return view('frontend.checkout.index');
    }    

    public function thankYou() {
        return view('frontend.checkout.thank-you');
    }
}
