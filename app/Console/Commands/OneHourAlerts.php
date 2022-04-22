<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class OneHourAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'one:hour_alerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'one hour alerts sent.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $Today = Carbon::parse()->format('Y-m-d');

        $this->info('One hour alert sent to maid !');
    }

}
