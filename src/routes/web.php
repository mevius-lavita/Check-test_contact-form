<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\ExportController;

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

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks',[ContactController::class,'store']);


Route::get('/register', [UserController::class, 'register']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/login', [UserController::class, 'showLogin']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('user')->group(function () {
    Route::get('/admin', [UserController::class, 'admin']);
    Route::get('/reset', fn() => redirect('/admin'));
    Route::get('/search', [UserController::class, 'search']);
});
Route::delete('/delete', [UserController::class, 'remove']);

Route::get('/export', [ExportController::class, 'export']);
Route::get('/export', [UserController::class, 'export']);