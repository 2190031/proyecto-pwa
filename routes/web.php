<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BillController, CategoryController, OrderController, OrderDetailController, PayMethodController, ProductController, UserController};

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [UserController::class, 'renderLogin'])->name('loginForm');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/signup', [UserController::class, 'renderSignup'])->name('signupForm');
Route::post('/signup', [UserController::class, 'store'])->name('signup');


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    // Public Routes (General Access)
    Route::get('/cart', function () {
        return view('cart');
    })->name('cart');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    // Orders and Order Details
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::post('/orders/{id}/reactivate', [OrderController::class, 'reactivate'])->name('orders.reactivate');
    Route::delete('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/order-details', [OrderDetailController::class, 'store']);

    Route::get('/bills', [BillController::class, 'index'])->name('bills.index');
    Route::get('/bills/create/{order_id}/', [BillController::class, 'create'])->name("bills.create");
    Route::post('/bills/{order_id}/{customer_id}/store', [BillController::class, 'store'])->name("bills.store");
    Route::get('/bills/{id}', [BillController::class, 'show'])->name("bills.show");
    Route::get('/bills/{id}/edit', [BillController::class, 'edit'])->name("bills.edit");
    Route::put('/bills/{id}', [BillController::class, 'update'])->name("bills.update");
    Route::delete('/bills/{id}', [BillController::class, 'destroy'])->name("bills.destroy");
    Route::delete('/bills/{id}/cancel', [BillController::class, 'cancel'])->name("bills.cancel");


    // Only Admin Routes
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/order-details', [OrderDetailController::class, 'index'])->name('orderdetails.index');
        Route::get('/pay-methods', [PayMethodController::class, 'index'])->name('paymethods.index');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');


        Route::get('/categories/create', [CategoryController::class, 'create'])->name("categories.create");
        Route::get('/pay/create-methods', [PayMethodController::class, 'create'])->name("paymethods.create");
        Route::get('/products/create', [ProductController::class, 'create'])->name("products.create");
        Route::get('/users/create', [UserController::class, 'create'])->name("users.create");

        Route::post('/categories', [CategoryController::class, 'store'])->name("categories.store");
        Route::post('/pay-methods', [PayMethodController::class, 'store'])->name("paymethods.store");
        Route::post('/products', [ProductController::class, 'store'])->name("products.store");
        Route::post('/users', [UserController::class, 'store'])->name("users.store");

        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name("categories.edit");
        Route::get('/pay-methods/{id}/edit', [PayMethodController::class, 'edit'])->name("paymethods.edit");
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name("products.edit");
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name("users.edit");

        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name("categories.update");
        Route::put('/pay-methods/{id}', [PayMethodController::class, 'update'])->name("paymethods.update");
        Route::put('/products/{id}', [ProductController::class, 'update'])->name("products.update");
        Route::put('/users/{id}', [UserController::class, 'update'])->name("users.update");

        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name("categories.destroy");
        Route::delete('/pay-methods/{id}', [PayMethodController::class, 'destroy'])->name("paymethods.destroy");
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name("products.destroy");
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name("users.destroy");
    });
});
