<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\SchedulesCollection;
use App\Models\Schedule;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class UserStandingsController extends Controller
{
    public function index()
    {
        return new SchedulesCollection(User::orderBy('points', 'desc')->get());
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return new ScheduleResource($user);
        }

        return [
            'data' => [
                'status' => 'failed',
                'error' => 404,
            ]
        ];
    }
}
