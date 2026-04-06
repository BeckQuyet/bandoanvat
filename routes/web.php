<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes - Dinh tuyen trang web
|--------------------------------------------------------------------------
| Trang cong khai: Trang chu, chi tiet san pham, gio hang
| Xac thuc: Dang nhap, dang ky (chi cho khach - guest)
| Nguoi dung: Don hang, tai khoan (yeu cau dang nhap - auth)
| Quan tri: Dashboard, CRUD san pham/danh muc/don hang (yeu cau role admin)
*/

// === TRANG CONG KHAI (khong can dang nhap) ===
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');

// Gio hang - luu trong session, khong can dang nhap
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

// === XAC THUC - Chi cho khach chua dang nhap ===
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// === NGUOI DUNG DA DANG NHAP ===
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Quan ly don hang cua nguoi dung
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    // Tai khoan ca nhan va doi mat khau
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// === QUAN TRI VIEN - Yeu cau role 'admin' ===
// Middleware: auth (phai dang nhap) + admin (kiem tra role)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class)->except('show'); // CRUD san pham
    Route::resource('categories', AdminCategoryController::class)->except('show'); // CRUD danh muc
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index'); // Danh sach don hang
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show'); // Chi tiet don
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus'); // Cap nhat trang thai
});
