<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function() {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('do-login', [LoginController::class, 'dologin'])->name('do.login');

    Route::group(['middleware' =>'admin'],function() {
        Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('userinfo', [LoginController::class, 'userinfo'])->name('userinfo');
        Route::get('useredit/{id}', [LoginController::class, 'edit'])->name('useredit');
        Route::post('userupdate', [LoginController::class, 'update'])->name('userupdate');
        Route::get('userdelete/{id}', [LoginController::class, 'delete'])->name('userdelete');
Route::get('oderinfo',[LoginController::class, 'orderinfo'])->name('orderinfo');
    Route::prefix('products')->name('product.')->group(function() {
        Route::get('/', [ProductController::class, 'list'])->name('list'); // This should be accessible
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('save', [ProductController::class, 'save'])->name('save');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('delete');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('update', [ProductController::class, 'update'])->name('update');


    });
});
});
