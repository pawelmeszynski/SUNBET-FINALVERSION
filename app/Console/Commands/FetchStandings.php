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
    protected $signature = 'standings:fetch {code}';

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
        ])->get('https://api.football-data.org/v4/competitions/' . $this->argument('code') . '/standings'));


        if(property_exists($response, 'standings')) {
            foreach ($response->standings as $standings) {
                $result = Standings::updateOrCreate(
                    [
                        'group' => $standings->group
                    ],
                    [
                        'stage' => $standings->stage,
                        'type' => $standings->type,
                    ]);
                foreach ($standings->table as $table) {

                    $team = Team::find($table->team->id);
                    $team->standings()->syncWithoutDetaching([
                        $result->id => ['position' => $table->position],
                    ]);

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
