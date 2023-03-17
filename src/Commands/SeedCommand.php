<?php

namespace Celysium\Seeder\Commands;

use Illuminate\Database\Console\Seeds\SeedCommand as BaseSeedCommand;
use Symfony\Component\Finder\Finder;

class SeedCommand extends BaseSeedCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:seed';

    public function handle()
    {
        parent::handle();
        $class = $this->input->getArgument('class') ?? $this->input->getOption('class');

        if ($class === "Database\Seeders\DatabaseSeeder") {
            $seeders = $this->seeders();
            foreach ($seeders as $seeder) {
                $this->input->setArgument('class', $seeder);
                parent::handle();
            }
        }
    }


    /**
     * Determine the seeders that should be runed.
     *
     * @return array
     */
    protected function seeders(): array
    {
        $app_path = app_path();
        $real_path = realpath($app_path) . DIRECTORY_SEPARATOR;
        $namespace = app()->getNamespace();
        return collect((new Finder)
            ->in($app_path)
            ->files()
            ->name('DatabaseSeeder.php'))
            ->map(fn ($class) =>
                 $namespace . str_replace(['/', '.php'], ['\\', ''], ltrim($class->getRealPath(), $real_path))
            )
            ->filter(fn ($class) => class_exists($class) && $this->isDatabaseSeeder($class))
            ->values()
            ->toArray();
    }

    /**
     * Determine if the given database seeder class is syncable.
     *
     * @param string $class
     * @return bool
     */
    protected function isDatabaseSeeder(string $class): bool
    {
        return in_array(\Illuminate\Database\Seeder::class, class_parents($class));
    }
}
