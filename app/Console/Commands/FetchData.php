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
            $exitCode = Artisan::call('teams:fetch ' . $competition->code);
            $exitCode = Artisan::call('matches:fetch ' . $competition->code);
            $exitCode = Artisan::call('standings:fetch ' . $competition->code);
        });

        return 0;
    }
}
