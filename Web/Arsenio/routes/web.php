<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AbyssController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BattleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MobileAppDownloadController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StoryController;

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


Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::resource('register', RegisterController::class)->middleware('guest');

Route::resource('home', HomeController::class)->middleware('auth');

Route::get('/story/{id}/{storyDesc}', [StoryController::class, 'index'])->middleware('auth');

Route::get('/abyss', [AbyssController::class, 'index'])->middleware('auth');

Route::get('/battle/{id}/{mode}/{answerCorrect}/{questionId}/{userHealth}/{firstAnim}/{abyssScore}/{useItem}/{countdown}/{lastQuestionId}', [BattleController::class, 'show'])->middleware('auth');

Route::get('/shop/{item_id}/{amount}/{showItemDetail}', [ShopController::class, 'index'])->middleware('auth');

Route::get('/admin', [AdminController::class, 'index'])->middleware('admin');

Route::get('/gameLogs', [AdminController::class, 'showGameLogs'])->middleware('admin');

Route::post('/admin/{userId}', [AdminController::class, 'banUser'])->middleware('admin');

Route::resource('question', QuestionController::class)->middleware('admin');

Route::get('/mobileAppsDownload', [MobileAppDownloadController::class, 'index']);