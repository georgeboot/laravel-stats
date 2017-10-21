<?php

namespace Wnx\LaravelStats;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Wnx\LaravelStats\Commands\StatsListCommand;

class StatsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $source = realpath($raw = __DIR__.'/../config/stats.php') ?: $raw;

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('stats.php')], 'config');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('stats');
        }

        $this->mergeConfigFrom($source, 'stats');
    }

    public function register()
    {
        $this->commands([
            StatsListCommand::class,
        ]);
    }
}
