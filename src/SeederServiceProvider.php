<?php

namespace Celysium\Seeder;

use Celysium\Seeder\Commands\SeedCommand;
use Illuminate\Support\ServiceProvider;

class SeederServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            SeedCommand::class,
        ]);
    }

    public function register()
    {
        //
    }
}
