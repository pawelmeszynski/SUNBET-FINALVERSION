<?php

namespace App\Console\Commands;

use App\Models\Area;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchAreas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'areas:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all areas from football-data.org';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = json_decode(Http::withHeaders([
            'X-Auth-Token' => 'eb39c4511bf64a388e73dc566a8a99cd',
        ])->get('https://api.football-data.org/v4/areas'));


        foreach ($response->areas as $areas) {
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
        return 0;
    }
}
