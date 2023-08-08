<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;

class FrontendController extends Controller
{
    public function index() {
        $sliders = Slider::where('status', '0')->get();
        $trendingProducts = Product::where('trending', '1')->latest()->get();
        return view('frontend.index', compact('sliders', 'trendingProducts'));
    }

    public function categories() {
        $categories = Category::where('status', '0')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($categorySlug) {
        $category = Category::where('slug', $categorySlug)->first();
        
        if ($category) {
            $products = $category->products()->get();
            return view('frontend.collections.products.index', compact('products', 'category'));
        } else {
            return redirect()->back();
        }
    }

    public function productView(string $categorySlug, string $productSlug) {
        $category = Category::where('slug', $categorySlug)->first();
        $product = $category->products()->where('slug', $productSlug)->where('status', 0)->first();

        if ($category && $product) {  
            return view('frontend.collections.products.view', compact('product', 'category'));
        } else {
            return redirect()->back();
        }
    }

    public function newArrivals() {
        $newArrivals = Product::latest()->get();
        return view('frontend.pages.new-arrivals', compact('newArrivals'));
    }

    public function featuredProducts() {
        $features = Product::where('featured', 1)->latest()->get();
        return view('frontend.pages.featured', compact('features'));
    }
}
