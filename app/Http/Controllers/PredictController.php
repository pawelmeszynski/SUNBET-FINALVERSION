<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScoreRequest;
use App\Http\Requests\UpdateScoreRequest;
use App\Models\Predict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PredictController extends Controller
{
    public function create(StoreScoreRequest $request)
    {
        $data = $request->except('_token');

        Predict::create([
            'match_id' => $data['match_id'],
            'user_id' => Auth::user()?->id ?? null,
            'home_team_goals' => $data['home_team_goals'],
            'away_team_goals' => $data['away_team_goals'],
        ]);

        return to_route('matches.index');
    }
    public function update(UpdateScoreRequest $updateScoreRequest, Predict $predict): \Illuminate\Http\RedirectResponse
    {
        $data = $updateScoreRequest->validated(); //get only validated data
        $result = $predict->update([
            'home_team_goals' => $data['home_team_goals'],
            'away_team_goals' => $data['away_team_goals'],
        ]); //update email and avatar with new data
        return back()->with([
            'status' => [
                'status' => $result ? 'success' : 'failed',
                'message' => $result ? 'Mail succesfully edited' : 'Something went wrong, sorry',
            ],
        ]);
    }
}
