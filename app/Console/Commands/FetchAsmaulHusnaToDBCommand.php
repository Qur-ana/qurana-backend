<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Feature\AsmaulHusna\AsmaulHusna;

class FetchAsmaulHusnaToDBCommand extends Command
{
    private string $host;
    private Client $client;

    public function __construct()
    {
        parent::__construct();
        $this->host = 'https://raw.githubusercontent.com/mikqi/dzikir-counter/master/www/asmaul-husna.json';
        $this->client = new Client();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-asmaul-husna';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Asmaul Husna from API to DB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = $this->client->request('GET', $this->host);
        $asmaulHusna = json_decode($response->getBody()->getContents(), true);
        foreach ($asmaulHusna as $asma) {
            AsmaulHusna::create([
                'name' => $asma['arab'],
                'name_latin' => $asma['latin'],
                'meaning_id' => $asma['arti'],
            ]);
            echo "Asmaul Husna " . $asma['arab'] . " successfully saved\n";
        }
    }
}
