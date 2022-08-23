<?php

namespace App\Console\Commands;

use App\Models\Competition;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'players:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all players from footballdata-org.com API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $progressbar = $this->output->createProgressBar();
        $progressbar->start();


        $response = Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/competitions/2013/teams')->object();
//        dd($response->teams->id);
        if (!property_exists($response, 'players')) {
            foreach ($response->teams as $team) {
//                Player::updateOrCreate(
//                    [
//                        'team_id' => $team->id,
//                    ],
//                );
                foreach ($team->squad as $players) {
                    Player::create(
                    [
                        'team_id' => $team->id,
                        'name' => $players->name ?? 0,
                        'position'=> $players->position ?? 0,
                        'dateOfBirth'=> $players->dateOfBirth ?? null,
                        'nationality'=> $players->nationality ?? 0,
                    ]
                );
                    $progressbar->advance();
                }
            }
        } else {
            dump($response);
        }
                    $progressbar->finish();

        return 0;
    }
}
