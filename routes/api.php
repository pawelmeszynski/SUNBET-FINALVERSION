<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\MatchesController;
use App\Http\Controllers\Api\StandingsController;
use App\Http\Controllers\Api\TeamsController;
use App\Http\Controllers\Api\UserStandingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('register', [AuthApiController::class, 'register']);

Route::post('login', [AuthApiController::class, 'login']);



//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [AuthApiController::class, 'logout']);
    Route::get('user',function(Request $request){
        return $request->user();
    });
});

//Route::middleware('auth:sanctum')->group(function() {

    Route::apiresource('matches', MatchesController::class)->except('show');

    Route::get('/matches', [MatchesController::class, 'index']);

    Route::get('/matches/{id}', [MatchesController::class, 'show']);

    Route::post('/matches/predict', [MatchesController::class, 'store']);

    Route::get('/predicts', [MatchesController::class, 'predicts']);

    Route::get('/predicts/{id}', [MatchesController::class, 'showPredict']);

    Route::get('/standings', [StandingsController::class, 'index']);

    Route::get('/standings/{id}', [StandingsController::class, 'show']);

    Route::get('/teams', [TeamsController::class, 'index']);

    Route::get('/teams/{id}', [TeamsController::class, 'show']);

    Route::get('/userstandings', [UserStandingsController::class, 'index']);

    Route::get('/userstandings/{id}', [UserStandingsController::class, 'show']);
//});
