<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PlanBookingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HotelBookingController;
use App\Http\Controllers\VehicleBookingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PlanController as AdminPlanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Travel Plans (Public)
Route::controller(PlanController::class)->group(function () {
    Route::get('/plans', 'index')->name('plans.index');
    Route::get('/plans/{plan}', 'show')->name('plans.show');
});

// Hotels
Route::controller(HotelController::class)->group(function () {
    Route::get('/hotels', 'index')->name('hotels.index');
    Route::get('/hotels/{hotel}', 'show')->name('hotels.show');
});

// Vehicles
Route::controller(VehicleController::class)->group(function () {
    Route::get('/vehicles', 'index')->name('vehicles.index');
    Route::get('/vehicles/{vehicle}', 'show')->name('vehicles.show');
    Route::post('/vehicles/{vehicle}/check-availability', 'checkAvailability')->name('vehicles.check-availability');
});

// Products
Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');
    Route::get('/products/{product}', 'show')->name('products.show');
});

// Authentication Routes
Auth::routes();

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    // Bookings
    Route::controller(BookingController::class)->group(function () {
        Route::get('/plans/{plan}/book', 'create')->name('bookings.create');
        Route::post('/plans/{plan}/book', 'store')->name('bookings.store');
        Route::get('/bookings/{Booking}', 'plans-show')->name('bookings.plans-show');
    });

    // Hotel Bookings
    Route::controller(HotelBookingController::class)->group(function () {
        Route::get('/hotels/{hotel}/book', 'create')->name('hotel-bookings.create');
        Route::post('/hotels/{hotel}/bookings', 'store')->name('hotel-bookings.store');
        Route::get('/hotel-bookings/{hotelBooking}', 'show')->name('hotel-bookings.show');
    });

    // routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/my-hotel-bookings', [HotelBookingController::class, 'index'])
         ->name('hotel-bookings.index');
});

    // Vehicle Bookings
    Route::controller(VehicleBookingController::class)->group(function () {
        Route::post('/vehicles/{vehicle}/book', 'store')->name('vehicle.bookings.store');
        Route::get('/bookings/{booking}', 'show')->name('bookings.show');
    });

    // Cart & Checkout
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart', 'index')->name('cart.index');
        Route::post('/cart/add/{product}', 'add')->name('cart.add');
        Route::put('/cart/update/{product}', 'update')->name('cart.update');
        Route::delete('/cart/remove/{product}', 'remove')->name('cart.remove');
    });

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'index')->name('checkout.index');
        Route::post('/checkout/process', 'processPayment')->name('checkout.process');
        Route::get('/checkout/success', 'success')->name('checkout.success');
    });
});



// Admin Panel Routes
Route::prefix('admin')
    ->middleware(['auth'])
    ->controller(\App\Http\Controllers\Admin\DashboardController::class)
    ->group(function () {
        Route::get('/dashboard', 'index')->name('admin.dashboard');

        // Users
        Route::controller(UserController::class)->group(function () {
            Route::get('/users', 'index')->name('admin.users.index');
            Route::delete('/users/{id}', 'destroy')->name('admin.users.destroy');
        });

        // Plans
        Route::controller(AdminPlanController::class)->group(function () {
            Route::get('/plans', 'index')->name('admin.plans.index');
            Route::get('/plans/create', 'create')->name('admin.plans.create');
            Route::post('/plans', 'store')->name('admin.plans.store');
            Route::get('/plans/{plan}/edit', 'edit')->name('admin.plans.edit');
            Route::put('/plans/{plan}', 'update')->name('admin.plans.update');
            Route::delete('/plans/{plan}', 'destroy')->name('admin.plans.destroy');
        });


         // Admin Vehicle Routes
Route::prefix('vehicles')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\VehicleController::class, 'index'])->name('admin.vehicles.index');
    Route::get('/create', [App\Http\Controllers\Admin\VehicleController::class, 'create'])->name('admin.vehicles.create');
    Route::post('/', [App\Http\Controllers\Admin\VehicleController::class, 'store'])->name('admin.vehicles.store');
    Route::get('/{vehicle}/edit', [App\Http\Controllers\Admin\VehicleController::class, 'edit'])->name('admin.vehicles.edit');
    Route::put('/{vehicle}', [App\Http\Controllers\Admin\VehicleController::class, 'update'])->name('admin.vehicles.update');
    Route::delete('/{vehicle}', [App\Http\Controllers\Admin\VehicleController::class, 'destroy'])->name('admin.vehicles.destroy');
});


// Admin Hotel Routes
Route::prefix('hotels')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HotelController::class, 'index'])->name('admin.hotels.index');
    Route::get('/create', [App\Http\Controllers\Admin\HotelController::class, 'create'])->name('admin.hotels.create');
    Route::post('/', [App\Http\Controllers\Admin\HotelController::class, 'store'])->name('admin.hotels.store');
    Route::get('/{hotel}/edit', [App\Http\Controllers\Admin\HotelController::class, 'edit'])->name('admin.hotels.edit');
    Route::put('/{hotel}', [App\Http\Controllers\Admin\HotelController::class, 'update'])->name('admin.hotels.update');
    Route::delete('/{hotel}', [App\Http\Controllers\Admin\HotelController::class, 'destroy'])->name('admin.hotels.destroy');
});

// Admin Product Routes
Route::prefix('store')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');
});

        // Add more admin routes here later
    });

// Custom Admin Login Page
Route::get('/admin/login', [\App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\Admin\LoginController::class, 'login']);
Route::post('/admin/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');

// User Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/dashboard/profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('user.dashboard.profile');
    Route::post('/dashboard/profile/update-name', [App\Http\Controllers\DashboardController::class, 'updateName'])->name('user.update.name');
    Route::post('/dashboard/profile/change-password', [App\Http\Controllers\DashboardController::class, 'changePassword'])->name('user.change.password');
    Route::post('/dashboard/profile/delete-account', [App\Http\Controllers\DashboardController::class, 'deleteAccount'])->name('user.delete.account');
});

// plans Booking routes
// Add these inside your auth middleware group if you want them protected
Route::middleware(['auth'])->group(function () {
    // Booking routes
    Route::post('/plans/{plan}/bookings', [PlanBookingController::class, 'store'])
        ->name('bookings.store');
    
    Route::get('/my-bookings', [PlanBookingController::class, 'index'])
        ->name('bookings.index');
    
    Route::get('/bookings/{booking}', [PlanBookingController::class, 'show'])
        ->name('bookings.show');
});



// vehicle booking routes
Route::middleware(['auth'])->group(function () {
    Route::get('/my-vehicle-bookings', [VehicleBookingController::class, 'userBookings'])
         ->name('vehicle-bookings.history');
});




// Admin - User Bookings (only plans and hotels)
Route::prefix('bookings')->group(function () {
    // List all users with bookings
    Route::get('/', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('admin.bookings.index');

    // Show bookings for specific user
    Route::get('/{user}/plans', [App\Http\Controllers\Admin\BookingController::class, 'showPlanBookings'])->name('admin.bookings.plans');
    Route::get('/{user}/hotels', [App\Http\Controllers\Admin\BookingController::class, 'showHotelBookings'])->name('admin.bookings.hotels');
});