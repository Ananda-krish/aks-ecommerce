<?php

use App\Http\Controllers\User\HomepageController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\User\UserProfilecontroller;
use Illuminate\Support\Facades\Route;


// User login
Route::get('/login', function () {
    return view('users.login'); // Create a login view
})->name('login');


// User registration
Route::post('/register', [HomepageController::class, 'register'])->name('register');
Route::post('/login', [HomepageController::class, 'login'])->name('login.submit');
// Show the registration form
Route::get('/register', [HomepageController::class, 'showRegisterForm'])->name('register.form');




Route::middleware('auth')->group(function () {
    Route::get('/',[HomepageController::class,'home']);
    Route::get('userproduct', [HomepageController::class, 'userproduct'])->name('userproduct');
    Route::get('usercart', [HomepageController::class, 'cart'])->name('usercart');
    Route::post('/cart/add', [HomepageController::class, 'add'])->name('cart.add');
    Route::post('/logout', [HomepageController::class, 'logout'])->name('logout');
    Route::delete('cart/remove', [HomepageController::class, 'remove'])->name('cart.remove');
   // Route for handling the regular search (non-AJAX)
Route::get('/search', [SearchController::class, 'autocomplete'])->name('autocomplete');

// Route for handling AJAX-based autocomplete suggestions
Route::get('/autocomplete', [SearchController::class, 'autocompleteSuggestions'])->name('autocomplete.suggestions');

Route::get('/user/profile', [UserProfilecontroller::class, 'showprofile'])->name('user.profile');


Route::post('/checkout', [HomepageController::class, 'checkout'])->name('checkout');
    Route::get('payment',[HomepageController::class,'payment'])->name('payment');
    Route::post('paypal',[HomepageController::class,'paypal'])->name('paypal');
    Route::get('success',[HomepageController::class,'success'])->name('success');
    Route::get('cancel',[HomepageController::class,'cancel'])->name('cancel');
});
