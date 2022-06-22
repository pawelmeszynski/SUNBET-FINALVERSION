<?php

namespace App\Console\Commands;

use App\Models\Area;
use App\Models\Competition;
use App\Models\Schedule;
use App\Models\Standings;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
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
        Artisan::call('areas:fetch');

        Artisan::call('competitions:fetch');


        $competitions = Competition::all('code');
        $competitions->each(function ($competition) {
            $exitCode = Artisan::call('teams:fetch', [
                'code' => $competition->code,
            ]);
            $teams_response = Http::withHeaders([
                'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
            ])->get('https://api.football-data.org/v4/competitions/' . $competition->code . '/teams')->object();
                dd($teams_response);
            foreach ($teams_response->teams as $team) {
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

                    $competition->teams()->syncWithoutDetaching($team->id);
                }
            }

            $matches_response = json_decode(Http::withHeaders([
                'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
            ])->get('https://api.football-data.org/v4/competitions/' . $competition->code . '/matches'));


            foreach ($matches_response->matches as $match) {

                Schedule::updateOrCreate(
                    [
                        'id' => $match->id
                    ],
                    [
                        'home_team_id' => $match->homeTeam->id,
                        'away_team_id' => $match->awayTeam->id,
                        'competition_id' => $match->competition->id,
                        'utc_date' => Carbon::parse($match->utcDate)->toIso8601ZuluString(),
                        'status' => $match->status,
                        'matchday' => $match->matchday,
                        'stage' => $match->stage,
                        'group' => $match->group,
                        'last_updated_at' => Carbon::parse($match->lastUpdated),
                    ]
                );
            }
            Artisan::call('standings:fetch');
            $standings_response = json_decode(Http::withHeaders([
                'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
            ])->get('https://api.football-data.org/v4/competitions/' . $competition->code . '/standings'));


            foreach ($standings_response->standings as $standings) {
//            dd($standings);
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
        });

        return 0;
    }
}
