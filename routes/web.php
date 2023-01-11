<?php

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'posts' => PostController::class,
]);

Route::middleware('auth')->prefix('admin')->group(function (){

    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

    Route::resource('/postsAdmin', AdminPostController::class);
    Route::resource('/user', UserProfileController::class);

});


