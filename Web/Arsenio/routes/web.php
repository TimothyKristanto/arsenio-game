<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AbyssController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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


Route::get('/', [LoginController::class, 'index']);
Route::post('/', [LoginController::class, 'login']);

Route::resource('register', RegisterController::class);


Route::resource('home', HomeController::class);

Route::get('/abyss', [AbyssController::class, 'index']);
