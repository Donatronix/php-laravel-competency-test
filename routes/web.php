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


//Route::group(['middleware' => ['auth']], function () {

Route::get('/', [UsersController::class, 'index']);

Route::controller(UsersController::class)
    ->prefix('users')
    ->as('users.')
    ->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('create', [UsersController::class, 'create'])->name('create');
        Route::post('store', [UsersController::class, 'store'])->name('store');
        Route::get('edit/{id}', [UsersController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [UsersController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [UsersController::class, 'delete'])->name('delete');

        Route::prefix('payment-methods')
            ->group(function () {
                Route::get('/new', 'addNewPaymentMethod')->name('add-new-payment-method');
                Route::post('/add', 'addPaymentMethod')->name('add-payment-method');
                Route::delete('/{id}/remove', 'removePaymentMethod')->name('remove-payment-method');
                Route::delete('/remove-all', 'removeAllPaymentMethods')->name('remove-all-payment-methods');
            });
    });

Route::controller(PaymentMethodsController::class)
    ->prefix('payment-methods')
    ->as('payment-methods.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('delete/{id}', 'destroy')->name('delete');
    });

//});
