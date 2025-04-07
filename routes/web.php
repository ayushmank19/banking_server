<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/transactions/create', [TransactionController::class, 'create']);
Route::post('/transactions', [TransactionController::class, 'store']);
