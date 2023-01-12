<?php

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'posts' => PostController::class,
]);

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

    Route::resource('/postsAdmin', AdminPostController::class);

    Route::middleware('role:admin')->group(function () {

        Route::put('/user/{user}/attach', [App\Http\Controllers\UserProfileController::class, 'attachRole'])->name('attach-role-user');
        Route::put('/user/{user}/detach', [App\Http\Controllers\UserProfileController::class, 'detachRole'])->name('detach-role-user');
        Route::resource('/users', AdminUsersController::class);
    });

    Route::resource('/user', UserProfileController::class)->middleware('can:view,user');

});


