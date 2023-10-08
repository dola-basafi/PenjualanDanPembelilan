<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return redirect()->route('login');
});
Route::get('/login', function () {
  if (Auth::check()) {
    return redirect()->route('invIndex')->with('success', 'anda sudah login');
  }
  return view('login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::middleware(['auth'])->group(function () {
  Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
  Route::prefix('inventory')->group(function () {
    Route::get('/', [InventoryController::class, 'index'])->name('invIndex');
    Route::middleware(['Role:1'])->group(function () {
      Route::controller(InventoryController::class)->group(function () {
        Route::get('/edit/{id}', 'edit')->name('invEdit');
        Route::post('/edit/{id}', 'update')->name('invUpdate');
        Route::get('/create', 'create')->name('invCreate');
        Route::post('/create', 'store')->name('invStore');
        Route::delete('/delete/{id}', 'destroy')->name('indDelete');
        Route::get('/{admin}','index')->name('adminSalesPurchase');
      });
    });
  });
  Route::middleware(['Role:1,2'])->group(function () {
    Route::prefix('sales')->group(function () {
      Route::controller(SaleController::class)->group(function () {
        Route::post('/create', 'store')->name('saleStore');
        Route::get('/','index')->name('salesIndex');
        Route::get('/detail/{id}','detail')->name('salesDetail');
        Route::post('/edit/{id}','update')->name('salesUpdate');
        Route::delete('/delete/detail/{id}','destroySalesDetatils')->name('salesDestroyDetail');
        Route::delete('/delete/{id}','destroy')->name('salesDestroy');
      });
    });
  });
  Route::middleware(['Role:1,3'])->group(function () {
    Route::prefix('purchase')->group(function () {
      Route::controller(PurchaseController::class)->group(function () {
        Route::post('/create', 'store')->name('purchaseStore');
        Route::get('/','index')->name('purchaseIndex');
        Route::get('/detail/{id}','detail')->name('purchaseDetail');
        Route::post('/edit/{id}','update')->name('purchaseUpdate');


        Route::delete('/delete/detail/{id}','destroyPurchasesDetatils')->name('purchaseDestroyDetail');
        Route::delete('/delete/{id}','destroy')->name('purchaseDestroy');


      });
    });
  });
});
