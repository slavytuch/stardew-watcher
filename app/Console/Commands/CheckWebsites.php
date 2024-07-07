<?php

namespace App\Console\Commands;

use App\Models\Website;
use App\StardewWatcher\Services\CheckupService;
use Illuminate\Console\Command;

class CheckWebsites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-websites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Выполнить проверку сайтов';

    /**
     * Execute the console command.
     */
    public function handle(CheckupService $service)
    {
        foreach (Website::where('active', true)->get() as $website) {
            $service->checkWebsite($website);
        }
    }
}
