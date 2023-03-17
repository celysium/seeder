<?php

namespace Celysium\Seeder\Commands;

use Celysium\Seeder\Seeder;
use Illuminate\Database\Console\Seeds\SeedCommand as BaseSeedCommand;

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
        $this->input->setArgument('class', Seeder::class);
        parent::handle();
    }
}
