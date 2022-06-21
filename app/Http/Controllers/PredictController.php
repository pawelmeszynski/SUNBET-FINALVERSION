<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Predict;
use App\Models\UserStanding;
use Illuminate\Support\Facades\Auth;


class PredictController extends MatchesController
{
    public function points()
    {
        $points = UserStanding::all('points');
//        dd($points);
        if (Predict::where('home_team_goals', '>', 'away_team_goals') && Schedule::where('winner' == 'HOME_TEAM')) {
            UserStanding::create([
                'user_id' => Auth::user()?->id ?? null,
                $points->increment('points', 1),
            ]);
        } else if (Predict::where('home_team_goals', '>', 'away_team_goals') && Schedule::where('winner' == 'HOME_TEAM') && Schedule::where('home_team_goals' == 'home') && Schedule::where('away_team_goals' == 'away')) {
            UserStanding::create([
                'user_id' => Auth::user()?->id ?? null,
                $points->increment('points', 3),
            ]);
        } else if (Predict::where('away_team_goals', '>', 'home_team_goals') && Schedule::where('winner' == 'AWAY_TEAM') && Schedule::where('home_team_goals' == 'home') && Schedule::where('away_team_goals' == 'away')) {
            UserStanding::create([
                'user_id' => Auth::user()?->id ?? null,
                $points->increment('points', 3),
            ]);
        } else if (Predict::where('away_team_goals', '>', 'home_team_goals') && Schedule::where('winner' == 'AWAY_TEAM')) {
            UserStanding::create([
                'user_id' => Auth::user()?->id ?? null,
                $points->increment('points', 1),
            ]);
        } else if (Predict::where('away_team_goals', '=', 'home_team_goals') && Schedule::where('winner' == 'DRAW') && Schedule::where('home_team_goals' == 'home') && Schedule::where('away_team_goals' == 'away')) {
            UserStanding::create([
                'user_id' => Auth::user()?->id ?? null,
                $points->increment('points', 3)
            ]);
        } else if (Predict::where('away_team_goals', '=', 'home_team_goals') && Schedule::where('winner' == 'DRAW')) {
            UserStanding::create([
                'user_id' => Auth::user()?->id ?? null,
                $points->increment('points', 1),
            ]);
        } else {
            echo '<h1>NOT THIS TIME</h1>';
        }


    }
//
//    public function points()
//    {
//        if (Predict::where($homewinner=fullTime->winner->HOME_TEAM && 'match_id'=id)){
//            Predict::create([
//                'user_id' => Auth::user()?->id ?? null,
//                'points' => ('points + 1'),
//            ]);
//        } else if (Predict::where($awaywinner=fullTime->winner->AWAY_TEAM && 'match_id'=id)){
//            Predict::create([
//                'user_id' => Auth::user()?->id ?? null,
//                'points' => ('points + 1'),
//            ]);
//        } else if (Predict::where($draw=fullTime->winner->DRAW && 'match_id'=id)){
//            Predict::create([
//                'user_id' => Auth::user()?->id ?? null,
//                'points' => ('points + 1'),
//            ]);
//        } else
//
//    }
}
