<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamsController extends Controller
{
    public function index(): View
    {
        return view('matches.teams')->with([
            'teams' => Team::all(),
        ]); //show teams list
    }
}
