<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run database migrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Running migrations...');
        $exitCode = $this->call('migrate');
        $this->info('Migrations completed.');
        return $exitCode;
    }
}
