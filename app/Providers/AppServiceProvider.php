<?php

namespace App\Providers;

use App\StardewWatcher\Checkups\Abstracts\BaseCheckupAbstract;
use App\StardewWatcher\Services\CheckupService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->when([BaseCheckupAbstract::class, CheckupService::class])
            ->needs(LoggerInterface::class)
            ->give(static fn() => Log::channel('daily'));
    }
}
