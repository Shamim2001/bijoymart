<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\SiteController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\WithdrawalController;
use App\Http\Controllers\PagesController;

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/product/{slug1}/{slug2}/{slug3?}', [SiteController::class, 'products'])->name('products');
Route::post('/product/{slug?}', [SiteController::class, 'loadmore'])->name('loadmore');
Route::get('/down', function() {Artisan::call('down');return "now Down!";});
Route::get('/product/{slug}', [SiteController::class, 'product'])->name('product');
Route::get('product-category/{slug}/{slug2?}/{slug3?}', [SiteController::class, 'productByCategory'])->name('product.bycategory');
Route::post('/products/quickview/{slug}', [SiteController::class, 'productquickview'])->name('product.quickview');
Route::get('/search-ajax', [SiteController::class, 'product_search_ajax']);
Route::get('/search', [SiteController::class, 'product_search'])->name('product.search');
Route::post('/review/product', [SiteController::class, 'product_review'])->name('productreview');
Route::get('/review/reload', [SiteController::class, 'product_review_reload']);
Route::get('/cart/show', [CartController::class, 'index'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
Route::post('/cart/add/icon', [CartController::class, 'store_from_icon'])->name('store.from.icon');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.remove');
Route::get('/cart/remove-all', [CartController::class, 'removeall'])->name('cart.remove-all');
Route::get('/down', function() {Artisan::call('down');return "now Down!";});
Route::post('/cart/load-cart-item', [CartController::class, 'load_cart_item']);
Route::post('/checkout/orderStore', [CartController::class, 'orderStore'])->name('checkout.orderStore');
Route::get('/order/success/{orderNo}', [CartController::class, 'orderSuccess'])->name('order.success');
Route::get('/aboutUs', [PagesController::class, 'aboutUs'])->name('store.aboutUs');
Route::get('/blog', [PagesController::class, 'blog'])->name('store.blog');
Route::get('/blog/category/{slug}', [PagesController::class, 'blog_single'])->name('store.blog.single');
Route::get('/contactUs', [PagesController::class, 'contactUs'])->name('store.contactUs');
Route::prefix('auth')->name('customer.')->group(function () {
   Route::get('/login', [CustomerController::class, 'login_form'])->name('login');
   Route::post('/login', [CustomerController::class, 'login'])->name('login');
   Route::get('/register', [CustomerController::class, 'register_form'])->name('register');
   Route::post('/register', [CustomerController::class, 'register'])->name('register');
   Route::get('/logout', [CustomerController::class, 'logout'])->name('logout');
});
Route::prefix('customer')->name('customer.')->group(function () {
   Route::get('/myaccount', [CustomerController::class, 'myaccount'])->name('myaccount')->middleware('checkcustomer');
   Route::post('/addtolist', [CustomerController::class, 'addtolist'])->name('addtolist');
   Route::get('/wishlist/{phone}', [CustomerController::class, 'wishlist'])->name('wishlist')->middleware('checkcustomer');
   Route::post('/add_wishlist_to_cart', [CustomerController::class, 'add_wishlist_to_cart'])->name('add_wishlist_to_cart');
   Route::post('/clearwishlist', [CustomerController::class, 'clearwishlist'])->name('clearwishlist');
   Route::post('/load_wishlist_item', [CustomerController::class, 'load_wishlist_item'])->name('load_wishlist_item');
   Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
   Route::post('/checkout/shipping', [CustomerController::class, 'shipping'])->name('shipping');
   Route::get('/checkout/review-payment', [CustomerController::class, 'review_payment'])->name('review.payment')->middleware('checkcustomer');
   Route::post('/checkout/review-payment', [CustomerController::class, 'store_review_payment'])->name('store.review.payment');
   Route::get('/address', [CustomerController::class, 'address_form'])->name('address')->middleware('checkcustomer');
   Route::post('/address', [CustomerController::class, 'save_address'])->name('address');
   Route::post('/default-address', [CustomerController::class, 'default_address'])->name('default.address');
   Route::post('/data', [CustomerController::class, 'data'])->name('data');
   Route::get('/addressbook', [CustomerController::class, 'address_book'])->name('addressbook')->middleware('checkcustomer');
   Route::get('/myorder/{phone}', [CustomerController::class, 'myorder'])->name('myorder')->middleware('checkcustomer');

   // Withdrawal
    Route::get('/withdrawal/{customer}', [WithdrawalController::class, 'withdrawal'])->name('withdrawal')->middleware('checkcustomer');
    Route::post('/withdraw', [WithdrawalController::class, 'requestWithdrawal'])->name('withdraw.request')->middleware('checkcustomer');

});
