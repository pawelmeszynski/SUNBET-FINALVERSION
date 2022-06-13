<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch teams data from football-data.org API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = json_decode(Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/competitions/WC/teams'));

        foreach($response->teams as $team)
        {
            Team::create([
                'name' => $team->name,
                'shortName'=>$team->shortName,
                'tla' => $team->tla,
                'crest' => $team->crest,
                'address' => $team->address,
                'website' => $team->website,
                'founded' => $team->founded,
                'clubColors' => $team->clubColors,
                'venue' => $team->venue,
            ]);
        }

        $response2 = json_decode(Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/competitions/WC/matches'));



        foreach($response2->matches as $schedule)
        {
            Schedule::create([
                'utcDate' => Carbon::parse($schedule->utcDate),
                'status'=>$schedule->status,
                'matchday' => $schedule->matchday,
                'stage' => $schedule->stage,
                'group' => $schedule->group,
                'last_updated_at' => Carbon::parse($schedule->lastUpdated),
            ]);
        }



        return 0;
    }
}
