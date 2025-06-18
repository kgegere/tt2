<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::resource('listing', ListingController::class);

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::post('/listing/{listing}/purchase', [\App\Http\Controllers\ListingController::class, 'purchase'])->name('listing.purchase');
Route::get('/my-listings', [\App\Http\Controllers\ListingController::class, 'mine'])->name('listing.mine')->middleware('auth');
Route::get('/my-purchases', [PurchaseController::class, 'index'])->name('purchases.index')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/user', [\App\Http\Controllers\UserController::class, 'show'])->name('user.profile');
    Route::post('/user', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::post('/user/promote', [\App\Http\Controllers\UserController::class, 'promote'])->name('user.promote');
    Route::post('/user/demote', [\App\Http\Controllers\UserController::class, 'demote'])->name('user.demote');
    Route::get('/user/{id}', [\App\Http\Controllers\UserController::class, 'adminShow'])->name('user.admin.show');
    Route::get('/listing/{listing}/edit', [\App\Http\Controllers\ListingController::class, 'edit'])->name('listing.edit');
    Route::put('/listing/{listing}', [\App\Http\Controllers\ListingController::class, 'update'])->name('listing.update');
    Route::delete('/listing/{listing}', [\App\Http\Controllers\ListingController::class, 'destroy'])->name('listing.destroy');
    Route::get('/admin/users', [\App\Http\Controllers\UserController::class, 'index'])->name('admin.users')->middleware('can:viewAny,App\Models\User');
});

Route::get('/lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'lv'])) {
        abort(400);
    }
    session(['locale' => $locale]);
    app()->setLocale($locale);
    return back();
})->name('lang.switch');
Route::get('images/{path}', [\App\Http\Controllers\ImageController::class, 'show'])
    ->where('path', '.*')
    ->name('images.show');
Route::get('/lucky', [ListingController::class, 'lucky'])->name('listings.lucky');

