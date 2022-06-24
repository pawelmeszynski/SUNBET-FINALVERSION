<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScoreRequest;
use App\Models\Competition;
use App\Models\Predict;
use App\Models\Schedule;
use App\Models\Standings;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamsController extends Controller
{
    public function index(): View
    {
        return view('matches.teams')->with([
            'competitions' => Competition::all(),
        ]); //show teams list

    }

}
