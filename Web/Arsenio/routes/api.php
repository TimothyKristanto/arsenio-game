<?php

use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\AbyssController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\BattleController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\StoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [LoginController::class, 'login']);

Route::post('refresh', [LoginController::class, 'refresh']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::post('logout', [LoginController::class, 'logout']);
    Route::apiResource('home', HomeController::class);
    Route::get('/story/{id}', [StoryController::class, 'show']);
    Route::get('/abyss', [AbyssController::class, 'show']);
    Route::get('/battle/{levelId}/{questionIndex}', [BattleController::class, 'storyShow']);
    Route::get('/battle/{levelId}', [BattleController::class, 'index']);
    Route::post('/battle/{levelId}', [BattleController::class, 'storyUpdate']);
    Route::get('/abyss/battle/{questionIndex}', [BattleController::class, 'abyssShow']);
    Route::post('/abyss/battle/{battleScore}', [BattleController::class, 'abyssUpdate']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
