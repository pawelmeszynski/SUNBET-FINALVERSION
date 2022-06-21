<?php

namespace App\Console\Commands;

use App\Models\Predict;
use App\Models\Schedule;
use Illuminate\Console\Command;

class CalculatePoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'points:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate points';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schedules = Schedule::where('points_calculated', false)->where('status','FINISHED')->get();

        $schedules->each(function (Schedule $schedule) {
            $schedule->predicts->each(function(Predict $predict) use($schedule) {
                $isDraw = $schedule->home == $schedule->away;
                $userPredictedDraw = $predict->home_team_goals == $predict->away_team_goals;

                dump($userPredictedDraw);
                dd($predict);
            });
        });

        return 0;
    }
}
