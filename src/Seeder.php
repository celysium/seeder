<?php

namespace Celysium\Seeder;

use Illuminate\Database\Seeder as BaseSeeder;
use Illuminate\Support\Arr;

class Seeder extends BaseSeeder
{
    protected static array $classes = [];
    protected static bool $silent;
    protected static array $parameters = [];

    public static function load($class, $silent = false, array $parameters = [])
    {
        $classes = Arr::wrap($class);
        foreach ($classes as $perority => $seeder) {
            if(array_key_exists($perority, static::$classes)) {
                static::$classes[] = $seeder;
            }
            else {
                static::$classes[$perority] = $seeder;
            }
        }
        ksort($classes);

        static::$silent = $silent;
        static::$parameters = $parameters;
    }

    public function run(): void
    {
        $this->call(self::$classes, self::$silent, self::$parameters);
    }
}
