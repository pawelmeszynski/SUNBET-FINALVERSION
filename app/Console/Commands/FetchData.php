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

class   FetchData extends Command
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
    protected $description = 'Fetch all data from football-data.org';

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
        $response1 = json_decode(Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/areas'));


        foreach ($response1->areas as $areas) {
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
        $response2 = json_decode(Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/competitions'));


        foreach ($response2->competitions as $competitions) {
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
        $response3 = json_decode(Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/competitions/WC/matches'));


        foreach ($response3->matches as $match) {

            Schedule::updateOrCreate(
                [
                    'id' => $match->id
                ],
                [
                    'home_team_id' => $match->homeTeam->id,
                    'away_team_id' => $match->awayTeam->id,
                    'utc_date' => Carbon::parse($match->utcDate),
                    'status' => $match->status,
                    'matchday' => $match->matchday,
                    'stage' => $match->stage,
                    'group' => $match->group,
                    'last_updated_at' => Carbon::parse($match->lastUpdated),
                ]
            );
        }
        $response4 = json_decode(Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/competitions/WC/standings'));


        foreach ($response4->standings as $standings) {
//            dd($standings);
            Standings::updateOrCreate(
                [
                    'group' => $standings->group
                ],
                [
                    'stage' => $standings->stage,
                    'type' => $standings->type,
                ]);
//            foreach ($standings->table as $table) {
//                $team = Team::find($table->team->id);
//                $team->standings()->syncWithoutDetaching([
//                    1 => ['position' => $table->position],
//                    2 => ['position' => $table->position],
//                    3 => ['position' => $table->position],
//                    4 => ['position' => $table->position],
//                    5 => ['position' => $table->position],
//                    6 => ['position' => $table->position],
//                    7 => ['position' => $table->position],
//                    8 => ['position' => $table->position],
//                ]);
//
//            }
        }
        return 0;
    }
}
