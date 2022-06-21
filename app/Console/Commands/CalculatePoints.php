<?php

namespace App\Console\Commands;

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
        return 0;
    }
}
