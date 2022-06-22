<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\MatchesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiresource('matches', MatchesController::class)->except('show');

Route::get('/matches', [MatchesController::class, 'index']);

Route::get('/matches/{id}', [MatchesController::class, 'show']);

//Route::put('/emails/{id}/update', [EmailsController::class, 'update']);

Route::post('/emails/store', [MatchesController::class, 'store']);

