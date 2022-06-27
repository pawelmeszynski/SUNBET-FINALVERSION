<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\SchedulesCollection;
use App\Http\Resources\SchedulesResource;
use App\Models\Competition;
use App\Models\Schedule;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function index()
    {
//        return new SchedulesCollection(Team::all());
        $competitions = Competition::all();
        foreach($competitions as $competition){
            if ($competition->id == 2000) {
                return new SchedulesCollection($competition->teams);
            }
            return [
                'data' => [
                    'status' => 'failed',
                    'error' => 404,
                ]
            ];
        }
    }

    public function show($id)
    {
        $team = Team::find($id);

        if ($team) {
            return new ScheduleResource($team);
        }

        return [
            'data' => [
                'status' => 'failed',
                'error' => 404,
            ]
        ];
    }
}
