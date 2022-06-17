<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OngoingMatches extends Controller
{
    public function index(): View
    {
        return view('ongoing-matches-list')->with([
            'matches' => Schedule::all(),
            'teams' => Team::all(),
        ]); //show matches list
    }


}
