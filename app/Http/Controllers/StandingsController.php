<?php

namespace App\Http\Controllers;

use App\Models\Standings;
use App\Models\Schedule;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StandingsController extends Controller
{
    public function index(): View
    {
        return view('standings')->with([
            'standings' => Standings::all(),
        ]); //show matches list
    }
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->except('_token'); //get all data from request except _token
        Standings::create([
            'standings' => $data['standings'],
            'team_id' => $data['team_id'],
        ]); //store new email and avatar in database
        return redirect()->route('ongoing-matches-list'); //redirect to emails list
    }
}
