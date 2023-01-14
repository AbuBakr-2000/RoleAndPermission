<?php

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
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

        Route::resource('/roles', RoleController::class);
        Route::put('/roles/{role}/attach', [App\Http\Controllers\RoleController::class, 'attachPermission'])->name('attach-role-permission');
        Route::put('/roles/{role}/detach', [App\Http\Controllers\RoleController::class, 'detachPermission'])->name('detach-role-permission');

        Route::resource('/permissions', PermissionController::class);
    });

    Route::resource('/user', UserProfileController::class)->middleware('can:view,user');

});


