<?php

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\UserStandings;
use App\Http\Controllers\StandingsController;
use App\Models\Competition;
use App\Models\Schedule;
use App\Models\Team;
use Illuminate\Support\Facades\Artisan;
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

Route::middleware('auth')->prefix('matches')->group(function () {
    Route::get('/', [MatchesController::class, 'index'])->name('matches.index');
    Route::patch('/update', [MatchesController::class, 'update'])->name('matches.update');
    Route::post('create', [MatchesController::class, 'create'])->name('matches.create');
    Route::get('/predicts', [MatchesController::class, 'predicts'])->name('matches.predicts');
    Route::get('/players', [MatchesController::class, 'players'])->name('matches.players');
});

//Route::get('/predicts', [MatchesController::class, 'predicts'])->name('predicts');

Route::get('/userstanding', [UserStandings::class, 'index'])->name('userstanding');

Route::get('/standings', [StandingsController::class, 'index'])->name('standings');

Route::get('/teams', [TeamsController::class, 'index'])->name('teams');

Route::get('/migrate', function () {
    dump(Artisan::call('migrate'));
});

Route::get('/migrate-fresh', function () {
    dump(Artisan::call('migrate:fresh --seed'));
});

Route::get('/fetch-teams', function () {
    dump(Artisan::call('teams:fetch'));
});
Route::get('/fetch-standings', function () {
    dump(Artisan::call('standings:fetch'));
});
Route::get('/fetch-competitions', function () {
    dump(Artisan::call('competitions:fetch'));
});
Route::get('/fetch-areas', function () {
    dump(Artisan::call('areas:fetch'));
});
Route::get('/fetch-data', function () {
    dump(Artisan::call('data:fetch'));
});
Route::get('/fetch-matches', function () {
    dump(Artisan::call('matches:fetch'));
});
Route::get('/calculate-points', function () {
    dump(Artisan::call('points:calculate'));
});
Route::get('/fetch-players', function () {
    dump(Artisan::call('players:fetch'));
});
Route::group(['middleware' => ['auth']], function () {
    /**
     * Logout Route
     */
    Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
]);
