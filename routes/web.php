<?php

use App\Models\Competition;
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

Route::get('/', function() {
   $competition = Competition::find(2000);
   $area = $competition->area;

   dump('competiton: ' . $competition->name);
   dump('area: ' . $competition->area->name);
   dump('competions: ' . $area->competitions->count());

   dump('teams: ');
   dd($competition->teams);

});

Route::get('/migrate', function () {
    dump(Artisan::call('migrate'));
});

Route::get('/migrate-fresh', function () {
    dump(Artisan::call('migrate:fresh --seed'));
});

Route::get('/fetch-data', function () {
    dump(Artisan::call('data:fetch'));
});

Route::get('/test', function () {
    $test = \App\Models\Area::all();
    dd($test->area_id);
});
