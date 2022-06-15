<?php

namespace App\Console\Commands;

use App\Models\Area;
use App\Models\Competition;
use App\Models\Schedule;
use App\Models\Standings;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchStandings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'standings:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch official group standings from football-data.org API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

//        $name = $this->choice(
//            'Which teams you want to import?',
//            ['WC' => 'World Cup', 'EC'=> 'Euro Championship'],
//             0
//        );
//


        $response = json_decode(Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/competitions/WC/standings'));


        foreach ($response->standings as $standings) {
            Standings::create([
                'stage' => $standings->stage,
                'type' => $standings->type,
                'group' => $standings->group,
            ]);
            foreach($standings->runningCompetitions as $rel)
            {
                $teams = Team::find($rel->id);

                $teams->teams()->syncWithoutDetaching($standings->id);
            }
        }

        return 0;
    }
}
