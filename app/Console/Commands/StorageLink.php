<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StorageLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:link:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create symbolic link from public/storage to storage/app/public';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating storage link...');
        $exitCode = $this->call('storage:link');
        $this->info('Storage link created.');
        return $exitCode;
    }
}
