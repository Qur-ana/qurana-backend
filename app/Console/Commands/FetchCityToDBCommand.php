<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Feature\PrayerTimes\City;

class FetchCityToDBCommand extends Command
{
    private string $host;
    private Client $client;

    /**
     * Create a new command instance.
     * @return void
     */
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
    protected $signature = 'app:fetch-city';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch city from API and save to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = $this->client->request('GET', $this->host . '/sholat/kota/semua', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
        $data = json_decode($response->getBody()->getContents(), true);
        foreach($data as $city) {
            City::create([
                'external_id' => $city['id'],
                'name' => $city['lokasi'],
            ]);
            echo "City " . $city['lokasi'] . " successfully saved\n";
        }
        echo "++++++++++++++++++++++++Successfully Scrape entire City id++++++++++++++++++++++++\n";
    }
}
