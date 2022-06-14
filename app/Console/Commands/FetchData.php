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

//        $name = $this->choice(
//            'Which teams you want to import?',
//            ['WC' => 'World Cup', 'EC'=> 'Euro Championship'],
//             0
//        );
//        $response2 = json_decode(Http::withHeaders([
//            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
//        ])->get('https://api.football-data.org/v4/competitions/WC/matches'));
//
//
//        foreach ($response2->matches as $schedule) {
//            Schedule::updateOrCreate(
//                [
//                    'ext_id' => $schedule->id
//                ],
//                [
//                    'utcDate' => Carbon::parse($schedule->utcDate),
//                    'status' => $schedule->status,
//                    'matchday' => $schedule->matchday,
//                    'stage' => $schedule->stage,
//                    'group' => $schedule->group,
//                    'last_updated_at' => Carbon::parse($schedule->lastUpdated),
//                ]
//            );
//        }


        $response3 = json_decode(Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/competitions/WC/standings'));


        foreach ($response3->standings as $standings) {
            Standings::create([
                'stage' => $standings->stage,
                'type' => $standings->type,
                'group' => $standings->group,
            ]);
        }

        $response4 = json_decode(Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/areas'));


        foreach ($response4->areas as $areas) {
            Area::updateOrCreate(
                [
                    'id' => $areas->id,
                ],
                [
                    'id' => $areas->id,
                    'name' => $areas->name,
                    'countryCode' => $areas->countryCode,
                    'flag' => $areas->flag,
                    'parentAreaId' => $areas->parentAreaId,
                    'parentArea' => $areas->parentArea,
                ]
            );
        }
        $response5 = json_decode(Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/competitions'));


        foreach ($response5->competitions as $competitions) {
            Competition::updateOrCreate(
                [
                    'id' => $competitions->id,
                ],
                [
                    'id' => $competitions->id,
                    'name' => $competitions->name,
                    'code' => $competitions->code,
                    'type' => $competitions->type,
                    'emblem' => $competitions->emblem,
                    'plan' => $competitions->plan,
                    'area_id' => $competitions->area->id
                ]
            );
        }

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

            foreach($team->runningCompetitions as $comp)
            {
                $competition = Competition::find($comp->id);

                $competition->teams()->syncWithoutDetaching($team->id);
            }
        }

        return 0;
    }
}
