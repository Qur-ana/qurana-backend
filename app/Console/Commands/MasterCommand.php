<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MasterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo "Setting up the application...\n";
        echo "Generating application key...\n";
        $this->call('key:generate');
        echo "Migrating database...\n";
        $this->call('migrate');
        echo "Seeding database...\n";
        $this->call('db:seed');
        echo "Generating JWT secret...\n";
        $this->call('jwt:secret');
        echo "Fetching data Quran...\n";
        $this->call('app:fetch-quran');
        echo "Fetching data City...\n";
        $this->call('app:fetch-city');
        echo "Setup completed!\n";
    }
}
