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
        $newArrivals = Product::latest()->take(6)->get();
        $featuredProducts = Product::where('featured', 1)->take(6)->get();
        return view('frontend.index', compact('sliders', 'trendingProducts', 'newArrivals', 'featuredProducts'));
    }

    public function search(Request $request) {
        $searchItems = $request->input('search');
        $results = Product::where('name', 'LIKE', "%$searchItems%")->paginate(1);
        $results->appends(['search' => $searchItems]);
        
        return view('frontend.pages.search-results', compact('results'));
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
