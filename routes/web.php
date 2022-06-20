<?php

use App\Http\Controllers\PredictController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\OngoingMatchesController;
use App\Http\Controllers\StandingsController;
use App\Models\Competition;
use App\Models\Schedule;
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
    return view ('welcome');
});

Route::prefix('matches')->group(function() {
    Route::get('/', [OngoingMatchesController::class, 'index'])->name('matches.index');
    Route::patch('{match}', [PredictController::class, 'update'])->name('matches.update');
    Route::post('create', [PredictController::class, 'create'])->name('matches.create');
});

Route::get('/standings', [StandingsController::class, 'index'])->name('standings');

Route::get('/teams', [TeamsController::class, 'index'])->name('teams');

Route::get('/test', function() {
   $competition = Competition::find(2000);
   $area = $competition->area;
   $match = Schedule::first();
   dump('competiton: ' . $competition->name);
   dump('area: ' . $competition->area->name);
   dump('competions: ' . $area->competitions->count());

   dump('firstMatch: ');
   dump('home_team_id' . $match->home_team . 'away_team_id' . $match->away_team);

});

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
Route::get('/fetch-matches', function () {
    dump(Artisan::call('matches:fetch'));
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
]);
