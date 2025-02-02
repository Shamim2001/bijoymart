<?php

use Illuminate\Support\Facades\Route;

Route::prefix('seller/')->name('seller.')->group(function () {


   Route::get('dashboard', function () {
      return view('seller.dashboard');
   })->middleware(['auth', 'verified'])->name('dashboard');
});
