<?php

namespace App\Console\Commands;

use App\Models\Competition;
use App\Models\Standings;
use App\Models\Team;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teams:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching all teams from WC football.org api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/competitions/WC/teams')->object();


        foreach ($response->teams as $team) {
            Team::updateOrCreate(
                [
                    'id' => $team->id,
                ],
                [
                    'id' => $team->id,
                    'name' => $team->name,
                    'shortName' => $team->shortName,
                    'tla' => $team->tla,
                    'crest' => $team->crest,
                    'address' => $team->address,
                    'website' => $team->website,
                    'founded' => $team->founded,
                    'clubColors' => $team->clubColors,
                    'venue' => $team->venue,
                ]
            );
//            foreach($team->runningCompetitions as $comp)
//            {
////                dd($team);
//                $competition = Competition::find($comp->id);
//
//                $competition->teams()->syncWithoutDetaching($team->id);
//            }
        }


        return 0;
    }
}

