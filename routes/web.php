<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('usertype', function () {
    $userType = Auth::user()->user_type;

    if (in_array($userType, ['admin', 'staff'])) {
        return redirect()->route('admin.dashboard');
    } elseif ($userType === 'seller') {
        return redirect()->route('seller.dashboard');
    }

    return redirect()->route('login');
})->name('dashboard');



// main
// Route::get('usertype', function () {

//     if (Auth::user()->user_type === 'admin') {
//         return redirect()->route('admin.dashboard');
//     }
//     else if (Auth::user()->user_type === 'seller') {
//         return redirect()->route('seller.dashboard');
//     };
//     return redirect()->route('login');
// })->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/store_site.php';
// require __DIR__ . '/breadcrumbs.php';

// Google login
Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('auth/facebook', [SocialController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [SocialController::class, 'handleFacebookCallback']);

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
