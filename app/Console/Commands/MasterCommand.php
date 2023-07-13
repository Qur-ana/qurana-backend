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
        echo "
        ____                              
        / __ \                             
       | |  | |_   _ _ __ __ _ _ __   __ _ 
       | |  | | | | | '__/ _` | '_ \ / _` |
       | |__| | |_| | | | (_| | | | | (_| |
         \___\_\\__,_|_|  \__,_|_| |_|\__,_|
        \n";
        echo "Assalamuaalaikum Wr. Wb.\n";
        sleep(2);
        echo "Hi Developers, Welcome to the application setup wizard of Qurana.\n";
        sleep(2);
        echo "This wizard will prepare your application for first use.\n";
        sleep(2);
        echo "Generating application key...\n";
        $this->call('key:generate');
        echo "Key generated!\n";
        sleep(1);
        echo "Migrating database...\n";
        $this->call('migrate');
        echo "Database migrated";
        sleep(1);
        echo "Seeding database...\n";
        $this->call('db:seed');
        echo "Database seeded!\n";
        sleep(1);
        echo "Generating JWT secret...\n";
        $this->call('jwt:secret');
        echo "JWT secret generated!\n";
        sleep(1);
        echo "Fetching data Quran...\n";
        $this->call('app:fetch-quran');
        echo "Fetching data Quran completed!\n";
        sleep(1);
        echo "Fetching data City...\n";
        $this->call('app:fetch-city');
        sleep(1);
        echo "Fetching Asmaul Husna...\n";
        $this->call('app:fetch-asmaul-husna');
        echo "Fetching Asmaul Husna completed!\n";
        sleep(1);
        echo "++++++++++++++++++++++++Start Scrape Tafseer++++++++++++++++++++++++\n";
        echo "Will Fetch Tafseer from API and save to database\n";
        echo "It may take over 20 minutes, fetching 6236 ayah and use size of data around 17Mb\n";
        echo "Just Relax, take a cup of coffee and wait until it's done\n";
        sleep(2);
        $this->call('app:fetch-tafseer');
        echo "Setup completed!\n";
    }
}
