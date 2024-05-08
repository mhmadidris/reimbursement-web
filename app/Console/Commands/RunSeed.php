<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run database seeding';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Running database seeding...');
        $exitCode = $this->call('db:seed');
        $this->info('Seeding completed.');
        return $exitCode;
    }
}
