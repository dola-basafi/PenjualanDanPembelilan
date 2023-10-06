<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
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
  return view('login');
});
Route::get('/login',function(){
  if (Auth::check()) {
    return redirect()->route('invIndex')->with('success','anda sudah login');
  }
  return view('login');
});
Route::post('/login', [AuthController::class,'login'])->name('login');


Route::middleware(['auth'])->group(function () {
  Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
  Route::prefix('inventory')->group(function () {
    Route::get('/', [InventoryController::class, 'index'])->name('invIndex');
    Route::middleware(['Role:1'])->group(function () {
      Route::controller(InventoryController::class)->group(function () {
        Route::get('/edit/{id}','edit')->name('invEdit');
        Route::post('/edit/{id}','update')->name('invUpdate');
        Route::get('/create','create')->name('invCreate');
        Route::post('/create','store')->name('invStore');
        Route::delete('/delete/{id}','destroy')->name('indDelete');
      });
    });
  });
});
