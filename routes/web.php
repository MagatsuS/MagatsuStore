<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\HomeController;

//Auth Route
Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Home Route
Route::get('/', function () {
    $products = \App\Models\Product::all(); // Fetch products directly here
    return view('guest', compact('products'));
})->name('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/product/{id}', [ProductController::class, 'showGuestProduct'])->name('productGuest');

// Login and Registration Routes
Route::view('/login', 'login')->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::middleware(['role:owner'])->get('/owner', [LoginController::class, 'index'])->name('owner.owner');
Route::middleware(['role:owner'])->get('/owner', [OwnerController::class, 'index'])->name('owner.owner');
Route::get('/user', [UserController::class, 'index'])->name('user');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.post');

// User Dashboard (Protected Route)
Route::get('/user', function () {
    return response()->view('user.user')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                                  ->header('Pragma', 'no-cache');
})->middleware('auth')->name('user');

 // Owner Dashboard Route (Ensure only owners have access)
 Route::middleware('role:2')->get('/owner', [OwnerController::class, 'index'])->name('owner.page');

// Owner dashboard route (only accessible by owners)
Route::middleware(['auth', 'role:owner'])->get('/owner', [OwnerController::class, 'index'])->name('owner.owner');

// Route guest
Route::get('/product-guest', [ProductController::class, 'showGuestProduct'])->name('productGuest');

// Route to update the user profile
Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
Route::middleware('auth')->get('/profile', [UserController::class, 'show'])->name('user.profile');
Route::middleware('auth')->get('/user', [UserController::class, 'index'])->name('user');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // User Profile Route
    Route::get('/profile', [UserController::class, 'show'])->name('profile');
    
    // Route to update the user profile
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
    
    // Address routes
    Route::get('/address/create', [AddressController::class, 'create'])->name('address.create');
    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
    Route::get('/address', [AddressController::class, 'index'])->name('address.index');
});

// Route cart
Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
});
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Route Product
Route::get('/products', [ProductController::class, 'index'])->name('productUser');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product-guest/{id}', [ProductController::class, 'showGuestProduct'])->name('productGuest');

// Route shop
Route::get('/user', [ShopController::class, 'index'])->name('user');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('product.show');

// Route Payment
Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

// Payment Routes
Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/direct-checkout', [PaymentController::class, 'directCheckout'])->name('directCheckout');
Route::get('/success', [PaymentController::class, 'success'])->name('success');

// Order Routes
Route::get('/user/orders/{id}', [OrderController::class, 'showOrder'])->name('user.orders.show');
Route::get('/user/orders', [OrderController::class, 'index'])->name('user.userOrder');

// Address Route
Route::middleware('auth')->group(function () {
    // Show the user profile
    Route::get('/profile', [UserController::class, 'show'])->name('user.profile');

    // Route to update the user profile
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
    
    // Address routes
    Route::get('/address/create', [AddressController::class, 'create'])->name('address.create');
    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
    Route::get('address/edit/{id}', [AddressController::class, 'edit'])->name('address.edit');
    Route::put('address/{id}', [AddressController::class, 'update'])->name('address.update');
    Route::get('/address', [AddressController::class, 'index'])->name('address.index');
    Route::get('/address/show', [AddressController::class, 'show'])->name('address.show');
    Route::delete('address/{id}', [AddressController::class, 'destroy'])->name('address.destroy');
});
Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

// Optional: Direct Checkout route (if necessary for redirection logic)
Route::post('/checkout/direct', [CheckoutController::class, 'directCheckout'])->name('checkout.direct');

Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::post('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
// Checkout route
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

// Success and cancel routes for Stripe
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

// Routes for Owner Section
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function() {
    
    // Dashboard route for owner
    Route::get('/', [OwnerController::class, 'index'])->name('page');
    
    // Order-related routes for owner
    Route::get('/orders', [OwnerController::class, 'showAllOrders'])->name('orders');
    Route::get('/orders/{id}', [OwnerController::class, 'viewOrder'])->name('orders.view');
    Route::get('/orders/{id}/edit', [OwnerController::class, 'editOrder'])->name('orders.edit');
    Route::delete('/orders/{id}', [OwnerController::class, 'deleteOrder'])->name('orders.delete');
    
    // Product-related routes for owner
    Route::get('/products', [ProductController::class, 'index'])->name('products');                // List all products
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');   // Show product creation form
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');           // Store a new product
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');    // Edit an existing product
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update'); // Ensure this matches
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.delete'); // Delete a product
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.details');      // Show product details
});
