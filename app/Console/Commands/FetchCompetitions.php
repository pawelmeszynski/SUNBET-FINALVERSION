<?php

namespace App\Console\Commands;

use App\Models\Competition;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchCompetitions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'competitions:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all accessible competitions from football-data.org Api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = json_decode(Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/competitions'));


        foreach ($response->competitions as $competitions) {
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
        return 0;
    }
}
