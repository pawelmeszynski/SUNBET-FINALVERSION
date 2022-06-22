<?php

namespace App\Console\Commands;

use App\Models\Competition;
use App\Models\Standings;
use App\Models\Team;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

class FetchTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teams:fetch {code}';

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
        ])->get('https://api.football-data.org/v4/competitions/' . $this->argument('code') . '/teams')->object();

        if(property_exists($response, 'teams')) {
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
                foreach ($team->runningCompetitions as $comp) {
                    $competition = Competition::find($comp->id);
                    if($competition) {
                        $competition->teams()->syncWithoutDetaching($team->id);
                    }
                }
            }
        }
        else
        {
            dump($response);
        }


        return 0;
    }
}

