<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', \App\Http\Livewire\HomeComponent::class);

Route::get('/shop', \App\Http\Livewire\ShopComponent::class)->name('page.shop');

Route::get('/cart', \App\Http\Livewire\CartComponent::class)->name('product.cart');

Route::get('/checkout', \App\Http\Livewire\CheckoutComponent::class)->name('checkout');

Route::get('/product/{slug}', \App\Http\Livewire\DetailsComponent::class)->name('product.details');

Route::get('/product-category/{category:slug}', \App\Http\Livewire\CategoryComponent::class)->name('product.category');

Route::get('/search', \App\Http\Livewire\SearchComponent::class)->name('product.search');

Route::get('/wishlist',\App\Http\Livewire\WishlistComponent::class)->name('products.wishlist');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

// For User or Customer
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/dashboard', \App\Http\Livewire\User\UserDashboardComponent::class)->name('user.dashboard');
});

// For Admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard', \App\Http\Livewire\Admin\AdminDashboardComponent::class)->name('admin.dashboard');

    Route::get('/admin/categories', \App\Http\Livewire\Admin\AdminCategoryComponent::class)->name('admin.categories');
    Route::get('/admin/category/add', \App\Http\Livewire\Admin\AdminAddCategoryComponent::class)->name('admin.add.category');
    Route::get('/admin/category/edit/{category_slug}', \App\Http\Livewire\Admin\AdminEditCategoryComponent::class)->name('admin.edit.category');

    Route::get('/admin/products', \App\Http\Livewire\Admin\AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/product/add', \App\Http\Livewire\Admin\AdminAddProductComponent::class)->name('admin.add.product');
    Route::get('/admin/product/edit/{product_slug}', \App\Http\Livewire\Admin\AdminEditProductComponent::class)->name('admin.edit.product');

    Route::get('/admin/slider',\App\Http\Livewire\Admin\AdminHomeSliderComponent::class)->name('admin.homeslider');
    Route::get('/admin/slider/add',\App\Http\Livewire\Admin\AdminAddHomeSliderComponent::class)->name('admin.add.homeslider');
    Route::get('/admin/slider/edit/{slide_id}',\App\Http\Livewire\Admin\AdminEditHomeSliderComponent::class)->name('admin.edit.homeslider');

    Route::get('/admin/coupons', \App\Http\Livewire\Admin\AdminCouponComponent::class)->name('admin.coupons');
    Route::get('/admin/coupon/add', \App\Http\Livewire\Admin\AdminAddCouponComponent::class)->name('admin.add.coupon');
    Route::get('/admin/coupon/edit/{coupon_id}', \App\Http\Livewire\Admin\AdminEditCouponComponent::class)->name('admin.edit.coupon');

    Route::get('/admin/home-categories',\App\Http\Livewire\Admin\AdminHomeCategories::class)->name('admin.homecategories');

    Route::get('admin/sale',\App\Http\Livewire\Admin\AdminSaleComponent::class)->name('admin.sale');


});
