<?php

use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::group(['middleware' => ['auth']], function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::get('create', [UsersController::class, 'create'])->name('users.create');
        Route::post('store', [UsersController::class, 'store'])->name('users.store');
        Route::get('edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('update/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('delete/{id}', [UsersController::class, 'delete'])->name('users.delete');

        Route::get('/new', [UsersController::class, 'addNewPaymentMethod'])->name('users.payment-methods.add-new-payment-method');
        Route::post('/add', [UsersController::class, 'addPaymentMethod'])->name('users.payment-methods.add-payment-method');
        Route::delete('/{id}/{paymentMethod}/remove', [UsersController::class, 'removePaymentMethod'])->name('users.payment-methods.remove-payment-method');
        Route::get('/{id}/{paymentMethod}/default', [UsersController::class, 'makeDefault'])->name('users.payment-methods.default');
        Route::delete('/{id}/remove-all', [UsersController::class, 'removeAllPaymentMethods'])->name('users.payment-methods.remove-all-payment-methods');

    });

    Route::prefix('payment-methods')->group(function () {
        Route::get('/', [PaymentMethodsController::class, 'index'])->name('payment-methods.index');
        Route::get('/create', [PaymentMethodsController::class, 'create'])->name('payment-methods.create');
        Route::post('/store', [PaymentMethodsController::class, 'store'])->name('payment-methods.store');
        Route::get('edit/{id}', [PaymentMethodsController::class, 'edit'])->name('payment-methods.edit');
        Route::put('update/{id}', [PaymentMethodsController::class, 'update'])->name('payment-methods.update');
        Route::delete('delete/{id}', [PaymentMethodsController::class, 'destroy'])->name('payment-methods.delete');
    });

});
