<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserStandings extends Controller
{
    public function index(): View
    {
        return view('matches.userstanding')->with([
            'name' => User::orderBy('points', 'desc')->get()
        ]); //show user standing list
    }
}
