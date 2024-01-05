<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/search', 'search');
    Route::get('/collections', 'categories');
    Route::get('/collections/{categorySlug}', 'products');
    Route::get('/collections/{categorySlug}/{productSlug}', 'productView');
    Route::get('/new-arrivals', 'newArrivals');
    Route::get('/featured-products', 'featuredProducts');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index']);
    Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::get('/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::get('/thank-you', [App\Http\Controllers\Frontend\CheckoutController::class, 'thankYou']);
    Route::get('/orders', [App\Http\Controllers\Frontend\OrderController::class, 'index']);
    Route::get('/orders/{orderId}', [App\Http\Controllers\Frontend\OrderController::class, 'show']);
    Route::get('/profile', [App\Http\Controllers\Frontend\UserController::class, 'index']);
    Route::post('/profile', [App\Http\Controllers\Frontend\UserController::class, 'updateUserProfile']);
    Route::get('/change-password', [App\Http\Controllers\Frontend\UserController::class, 'showChangePasswordPage']);
    Route::post('/change-password', [App\Http\Controllers\Frontend\UserController::class, 'changePassword']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route for admin
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    //User route
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create']);
    Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store']);
    Route::get('/users/{userId}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::put('/users/{userId}', [App\Http\Controllers\Admin\UserController::class, 'update']);
    Route::get('/users/{userId}/delete', [App\Http\Controllers\Admin\UserController::class, 'delete']);
    
    //Admin settings route
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index']);
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'store']);

    //Category routes
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');
    });

    //Products routes
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product}/edit', 'edit');
        Route::get('/products/{product}/delete', 'destroy');
        Route::put('/products/{product}', 'update');
        Route::get('/product-image/{productImageId}/delete', 'destroyImage');
        Route::post('/product-color/{productColorId}', 'updateProductColorQuantity');
        Route::get('/product-color/{productColorId}/delete', 'deleteProductColor');
    });

    //Color routes
    Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function () {
        Route::get('/colors', 'index');
        Route::get('/colors/create', 'create');
        Route::post('/colors/create', 'store');
        Route::get('/colors/{color}/edit', 'edit');
        Route::put('/colors/{colorId}', 'update');
        Route::get('/colors/{colorId}/delete', 'destroy');
    });

    //Slider routes
    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders/create', 'store');
        Route::get('/sliders/{slider}/edit', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('/sliders/{slider}/delete', 'destroy');
    });

    //Order routes
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{orderId}', 'show');
        Route::put('/orders/{orderId}', 'updateStatus');
        Route::get('/invoice/{orderId}', 'viewInvoice');
        Route::get('/invoice/{orderId}/generate', 'pdfGenerate');
        Route::get('/invoice/{orderId}/mail', 'mailInvoice');
    });

    //Livewire Brand route
    Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class);
});