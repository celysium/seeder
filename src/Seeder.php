<?php

namespace Celysium\Seeder;

class Seeder
{
    protected array $seeders = [];

    public function add(string $priority, string $seeder): void
    {
        $this->seeders[] = [
            'priority' => $priority,
            'seeder' => $seeder,
        ];

        $this->sort();
    }

    protected function sort(): void
    {
        usort($this->seeders, fn($a, $b) => $a['priority'] > $b['priority']);
    }

    public function merge(array $seeders): void
    {
        foreach ($seeders as $priority => $seeder) {
            $this->seeders[] = [
                'priority' => $priority,
                'seeder' => $seeder,
            ];
        }

        $this->sort();
    }

    public function get(): array
    {
        return $this->seeders;
    }

    public function getSeeders(): array
    {
        return array_column($this->seeders, 'seeder');
    }
}
