<?php

use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ClientReviewController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\SellerController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\Backend\WebsiteController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::prefix('admin/')->name('admin.')->group(function () {


   Route::get('dashboard', function () {
      return view('admin.dashboard');
   })->middleware(['auth', 'verified'])->name('dashboard');


   Route::get('website/Info', [WebsiteController::class, 'websiteInfo'])->name('website.info');
   Route::put('websiteInfo/{id}', [WebsiteController::class, 'websiteInfoUpdate'])->name('website.info.update');


   // product
   Route::get('product', [ProductController::class, 'index'])->name('product.index');
   Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
   Route::post('product', [ProductController::class, 'store'])->name('product.store');
   Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
   Route::put('product/{id}', [ProductController::class, 'update'])->name('product.update');
   Route::get('product/{id}', [ProductController::class, 'delete'])->name('product.delete');
   Route::post('updateStatus', [ProductController::class, 'updateStatus'])->name('product.update.status');
   Route::get('sellerProduct', [ProductController::class, 'sellerProduct'])->name('product.seller.product');
   Route::get('productReview', [ProductController::class, 'productReview'])->name('product.review');

   // Category
   Route::get('category', [CategoryController::class, 'index'])->name('category.index');
   Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
   Route::post('category', [CategoryController::class, 'store'])->name('category.store');
   Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
   Route::put('category/{id}', [CategoryController::class, 'update'])->name('category.update');
   Route::get('category/{id}', [CategoryController::class, 'delete'])->name('category.delete');
   Route::post('upCategoryStatus', [CategoryController::class, 'updateCategoryStatus'])->name('updateCategoryStatus');

   // brand
   Route::get('brand', [BrandController::class, 'index'])->name('brand.index');
   Route::get('brand/create', [BrandController::class, 'create'])->name('brand.create');
   Route::post('brand', [BrandController::class, 'store'])->name('brand.store');
   Route::get('brand/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
   Route::put('brand/{id}', [BrandController::class, 'update'])->name('brand.update');
   Route::get('brand/{id}', [BrandController::class, 'delete'])->name('brand.delete');

   // color
   Route::get('color', [ColorController::class, 'index'])->name('color.index');
   Route::get('color/create', [ColorController::class, 'create'])->name('color.create');
   Route::post('color', [ColorController::class, 'store'])->name('color.store');
   Route::get('color/{id}/edit', [ColorController::class, 'edit'])->name('color.edit');
   Route::put('color/{id}', [ColorController::class, 'update'])->name('color.update');
   Route::get('color/{id}', [ColorController::class, 'delete'])->name('color.delete');

   // order routes
    Route::get('allOrders', [OrderController::class, 'allOrders'])->name('order.allOrders');
    Route::get('order/{id}/edit', [OrderController::class, 'editstatus'])->name('order.editstatus');
    Route::put('order/{id}/update', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::get('pendingOrder', [OrderController::class, 'pendingOrder'])->name('order.pendingOrder');
    Route::get('approvedOrder', [OrderController::class, 'approvedOrder'])->name('order.approvedOrder');
    Route::get('shippingOrder', [OrderController::class, 'shippingOrder'])->name('order.shippingOrder');
    Route::get('deliveredOrder', [OrderController::class, 'deliveredOrder'])->name('order.deliveredOrder');

    Route::get('cancelledOrder', [OrderController::class, 'cancelledOrder'])->name('order.cancelledOrder');


    // Route::get('details/{id}', [OrderController::class, 'details'])->name('order.details');
   Route::get('inHouseOrders', [OrderController::class, 'inHouseOrders'])->name('order.inHouseOrders');
   Route::get('sellerOrders', [OrderController::class, 'sellerOrders'])->name('order.sellerOrders');

   // seller routes
   Route::get('allSeller', [SellerController::class, 'allSeller'])->name('seller.allSeller');
   Route::get('payout', [SellerController::class, 'payout'])->name('seller.payout');
   Route::get('payoutRequest', [SellerController::class, 'payoutRequest'])->name('seller.payoutRequest');
   Route::get('sellerCommission', [SellerController::class, 'sellerCommission'])->name('seller.sellerCommission');

   // report routes
   Route::get('productStock', [ReportController::class, 'productStock'])->name('report.productStock');
   Route::get('productSale', [ReportController::class, 'productSale'])->name('report.productSale');
   Route::get('productWishlist', [ReportController::class, 'productWishlist'])->name('report.productWishlist');
   Route::get('lowStockProduct', [ReportController::class, 'lowStockProduct'])->name('report.lowStockProduct');

   // Home scroll section
   Route::get('homeSlider', [WebsiteController::class, 'homeSlider_index'])->name('home.homeSlider.index');
   Route::get('homeSlider/create', [WebsiteController::class, 'homeSlider_create'])->name('home.homeSlider.create');
   Route::post('homeSlider', [WebsiteController::class, 'homeSlider_store'])->name('home.homeSlider.store');
   Route::get('homeSlider/{id}/edit', [WebsiteController::class, 'homeSlider_edit'])->name('home.homeSlider.edit');
   Route::put('homeSlider/{id}', [WebsiteController::class, 'homeSlider_update'])->name('home.homeSlider.update');
   Route::get('homeSlider/{id}', [WebsiteController::class, 'homeSlider_delete'])->name('home.homeSlider.delete');

   Route::get('banner', [WebsiteController::class, 'banner_index'])->name('home.banner.index');
   Route::get('banner/create', [WebsiteController::class, 'banner_create'])->name('home.banner.create');
   Route::post('banner', [WebsiteController::class, 'banner_store'])->name('home.banner.store');
   Route::get('banner/{id}/edit', [WebsiteController::class, 'banner_edit'])->name('home.banner.edit');
   Route::put('banner/{id}', [WebsiteController::class, 'banner_update'])->name('home.banner.update');
   Route::get('banner/{id}', [WebsiteController::class, 'banner_delete'])->name('home.banner.delete');

   // Home Banner section
   Route::get('singleBanner', [WebsiteController::class, 'singleBanner_index'])->name('home.singleBanner.index');
   Route::get('singleBanner/create', [WebsiteController::class, 'singleBanner_create'])->name('home.singleBanner.create');
   Route::post('singleBanner', [WebsiteController::class, 'singleBanner_store'])->name('home.singleBanner.store');
   Route::get('singleBanner/{id}/edit', [WebsiteController::class, 'singleBanner_edit'])->name('home.singleBanner.edit');
   Route::put('singleBanner/{id}', [WebsiteController::class, 'singleBanner_update'])->name('home.singleBanner.update');
   Route::get('singleBanner/{id}', [WebsiteController::class, 'singleBanner_delete'])->name('home.singleBanner.delete');

   // Home page section
   Route::get('home-section', [WebsiteController::class, 'homeSection_index'])->name('home.section.index');
   Route::get('home-section/create', [WebsiteController::class, 'homeSection_create'])->name('home.section.create');
   Route::post('home-section', [WebsiteController::class, 'homeSection_store'])->name('home.section.store');
   Route::get('home-section/{id}/edit', [WebsiteController::class, 'homeSection_edit'])->name('home.section.edit');
   Route::put('home-section/{id}', [WebsiteController::class, 'homeSection_update'])->name('home.section.update');
   Route::get('home-section/{id}', [WebsiteController::class, 'homeSection_delete'])->name('home.section.delete');

   // home new section
   // Route::get('homeNewSection', [WebsiteController::class, 'homeNewSection_index'])->name('home.newSection.index');
   // Route::get('homeNewSection/create', [WebsiteController::class, 'homeNewSection_create'])->name('home.newSection.create');
   // Route::post('homeNewSection', [WebsiteController::class, 'homeNewSection_store'])->name('home.newSection.store');
   // Route::get('homeNewSection/{id}/edit', [WebsiteController::class, 'homeNewSection_edit'])->name('home.newSection.edit');
   // Route::put('homeNewSection/{id}', [WebsiteController::class, 'homeNewSection_update'])->name('home.newSection.update');
   // Route::get('homeNewSection/{id}', [WebsiteController::class, 'homeNewSection_delete'])->name('home.newSection.delete');

   Route::get('sectionProduct', [WebsiteController::class, 'sectionProductPublish'])->name('section.product');
   Route::post('updateSectionProductStatus', [WebsiteController::class, 'updateSectionProductStatus'])->name('section.product.update.status');


   //BLOG
   Route::get('blogCategory', [BlogController::class, 'blogCategory_index'])->name('blogCategory.index');
   // Route::get('blogCategory/create', [BlogController::class, 'blogCategory_create'])->name('blogCategory.create');
   Route::post('blogCategory', [BlogController::class, 'blogCategory_store'])->name('blogCategory.store');
   Route::get('blogCategory/{id}/edit', [BlogController::class, 'blogCategory_edit'])->name('blogCategory.edit');
   Route::put('blogCategory/{id}', [BlogController::class, 'blogCategory_update'])->name('blogCategory.update');
   Route::get('blogCategory/{id}', [BlogController::class, 'blogCategory_delete'])->name('blogCategory.delete');

   // blog Content
   Route::get('blogContent', [BlogController::class, 'blogContent_index'])->name('blogContent.index');
   Route::get('blogContent/create', [BlogController::class, 'blogContent_create'])->name('blogContent.create');
   Route::post('blogContent', [BlogController::class, 'blogContent_store'])->name('blogContent.store');
   Route::get('blogContent/{id}/edit', [BlogController::class, 'blogContent_edit'])->name('blogContent.edit');
   Route::put('blogContent/{id}', [BlogController::class, 'blogContent_update'])->name('blogContent.update');
   Route::get('blogContent/{id}', [BlogController::class, 'blogContent_delete'])->name('blogContent.delete');

   // ADMINISTRATION
   // Home Banner section
   Route::get('clientReview', [ClientReviewController::class, 'index'])->name('clientReview.index');
   Route::get('clientReview/create', [ClientReviewController::class, 'create'])->name('clientReview.create');
   Route::post('clientReview', [ClientReviewController::class, 'store'])->name('clientReview.store');
   Route::get('clientReview/{id}/edit', [ClientReviewController::class, 'edit'])->name('clientReview.edit');
   Route::put('clientReview/{id}', [ClientReviewController::class, 'update'])->name('clientReview.update');
   Route::get('clientReview/{id}', [ClientReviewController::class, 'delete'])->name('clientReview.delete');

   Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
   Route::put('settings/{id}', [SettingController::class, 'update_setting'])->name('setting.update');


   //STAFF MANAGE
   // Home Banner section
   Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
   Route::get('staff/create', [StaffController::class, 'create'])->name('staff.create');
   Route::post('staff', [StaffController::class, 'store'])->name('staff.store');
   Route::get('staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
   Route::put('staff/{id}', [StaffController::class, 'update'])->name('staff.update');
   Route::get('staff/{id}', [StaffController::class, 'delete'])->name('staff.delete');
});
