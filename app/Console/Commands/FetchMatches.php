<?php

namespace App\Console\Commands;

use App\Models\Competition;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'matches:fetch {code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching official schedule of World Cup in Qatar from footballorg.com Api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = json_decode(Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/competitions/' . $this->argument('code') . '/matches'));


        if(property_exists($response, 'matches')) {
            foreach ($response->matches as $match) {
//            dd($match->competition->id);

                dump($match->utcDate);
                dump(Carbon::parse($match->utcDate));
//            dd(Carbon::parse($match->utcDate)->toDateTimeString());
                Schedule::updateOrCreate(
                    [
                        'id' => $match->id
                    ],
                    [
                        'competition_id' => $match->competition->id,
                        'home_team_id' => $match->homeTeam->id,
                        'away_team_id' => $match->awayTeam->id,
                        'utc_date' => Carbon::parse($match->utcDate),
                        'status' => $match->status,
                        'matchday' => $match->matchday,
                        'stage' => $match->stage,
                        'group' => $match->group,
                        'last_updated_at' => Carbon::parse($match->lastUpdated),
                        'home' => $match->score->fullTime->home ?? 0,
                        'away' => $match->score->fullTime->away ?? 0,
                    ]);
            }
        }
        else
        {
            dump($response);
        }
    }

}
