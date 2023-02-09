<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\UsersController;
use App\Http\Controllers\Auth\UsersAuthController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\User\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Language
Route::get('lang/{locale}', [LanguageController::class, 'index'])->name('lang');

// LOGIN USERS
Route::prefix('login-auth')->group(function () {
    Route::get('user-login', [UsersAuthController::class, 'index'])->name('user.login');
    Route::post('post-login', [UsersAuthController::class, 'postLogin'])->name('user.login.post');

    Route::get('password-forgot', [UsersAuthController::class, 'forgotForm'])->name('password.forgot');
    Route::post('password-forgot', [UsersAuthController::class, 'sendResetLink'])->name('password.forgot.link');
    Route::get('password-reset/{token}', [UsersAuthController::class, 'showResetForm'])->name('reset.password.form');
    Route::post('password-reset', [UsersAuthController::class, 'resetPassword'])->name('reset.password');
});

Route::prefix('page-user')->middleware('UserRole')->group(function () {
    Route::get('user-dashboard', [UsersAuthController::class, 'dashboard'])->name('user.dashboard');
    Route::post('user-logout', [UsersAuthController::class, 'logout'])->name('user.logout');
});


//LOGIN ADMIN
Route::prefix('admin-auth')->group(function () {
    Route::get('admin-login', [AdminAuthController::class, 'index'])->name('login.admin');
    Route::post('post-login', [AdminAuthController::class, 'postLogin'])->name('admin.login.post');
});

Route::prefix('page-admin')->middleware('AdminRole')->group(function () {
    Route::get('admin-dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard.admin'); //trang chủ
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout.admin');
    // User list
    Route::get('admin-user', [UsersController::class, 'index'])->name('user.index');
    Route::get('user-create', [UsersController::class, 'create'])->name('user.create');
    Route::post('user-store', [UsersController::class, 'store'])->name('user.store');
    Route::get('edit/{id}', [UsersController::class, 'edit'])->name('user.edit');
    Route::post('user-edit/{id}', [UsersController::class, 'update'])->name('user.update');
    Route::get('delete/{id}', [UsersController::class, 'destroy'])->name('user.delete');

    //address
    Route::get('user-district', [UsersController::class, 'district'])->name('user.district');
    Route::get('user-commune', [UsersController::class, 'commune'])->name('user.commune');

    //Order
    Route::get('order', [OrderController::class, 'index'])->name('order.list');
    Route::get('order-detail/{id}', [UsersController::class, 'show'])->name('order.detail');
    Route::get('order-pdf/{id}', [UsersController::class, 'showPDF'])->name('order.PDF');

    // Category
    Route::get('admin-category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('admin-create', [CategoryController::class, 'create'])->name('catetogory.create');
    Route::post('admin-store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category-edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('caregory-post-edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category-delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    // Product
    Route::get('admin-product', [ProductController::class, 'index'])->name('product.index');
    Route::get('product-create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product-store', [ProductController::class, 'store'])->name('product.store');
    Route::get('product-detail/{id}', [ProductController::class, 'show'])->name('product.detail');
    Route::get('product-edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product-post-edit/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('product-delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

    //CSV, PDF
    Route::get('product-excel', [ProductController::class, 'export'])->name('product.excel');
    Route::get('product-pdf', [ProductController::class, 'createPDF'])->name('product.pdf');

    //Birthday
    Route::get('user-birthday', [UsersController::class, 'createPDF'])->name('user.birthday');
});
