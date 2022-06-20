<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScoreRequest;
use App\Models\Schedule;
use App\Models\Predict;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OngoingMatchesController extends Controller
{
    public function index(): View
    {
        return view('ongoing-matches-list')->with([
            'matches' => Schedule::paginate(2),
        ]); //show matches list
    }

}
