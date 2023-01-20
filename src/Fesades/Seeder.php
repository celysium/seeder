<?php

namespace Celysium\Seeder\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * @method static void add(string $priority, string $seeder)
 * @method static void merge(array $seeders)
 */
class Seeder extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'seeder';
    }
}
