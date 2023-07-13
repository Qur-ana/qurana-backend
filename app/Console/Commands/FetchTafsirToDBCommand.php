<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Feature\Quran\Tafseer;
use GuzzleHttp\Client;

class FetchTafsirToDBCommand extends Command
{
    private string $host;
    private Client $client;

    public function __construct(){
        parent::__construct();
        $this->host = config('externalhost.prayer_api_url');
        $this->client = new Client();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-tafseer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Tafseer from API to DB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client();
        for($i = 1; $i<= 6236; $i++){
            $response = $client->request('GET', $this->host . 'tafsir/quran/kemenag/id/' . $i);
            $tafseer = json_decode($response->getBody()->getContents(), true);
            Tafseer::create([
                'surah_id' => $tafseer['data'][0]['sura_id'],
                'ayah_id' => $i,
                'simple_tafseer' => $tafseer['data'][0]['text'],
                'full_tafseer' => $tafseer['data'][1]['text'],
            ]);
            echo "Tafseer ayah-" . $i . " successfully saved\n";
        }
    }
}
