<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Feature\Quran\Surah;
use App\Models\Feature\Quran\Ayah;

class FetchQuranToDBCommand extends Command
{
    private string $host;
    private Client $client;

    public function __construct()
    {
        parent::__construct();
        $this->host = config('externalhost.quran_api_url');
        $this->client = new Client();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-quran';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Quran from API to DB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->fetchListSurah();
        $this->fetchListAyat();
    }

    /**
     * fetch list surah
     *
     * @return void
     */
    private function fetchListSurah()
    {
        $response = $this->client->request('GET', $this->host . 'quran/surah');
        $surahs = json_decode($response->getBody()->getContents(), true);
        foreach ($surahs as $surah) {
            $surah['number'] = $surah['nomor'];
            $surah['name'] = $surah['nama'];
            $surah['name_latin'] = $surah['nama_latin'];
            $surah['number_of_ayah'] = $surah['jumlah_ayat'];
            $surah['place'] = $surah['tempat_turun'];
            $surah['meaning_id'] = $surah['arti'];
            $surah['description_id'] = $surah['deskripsi'];
            $surah['audio'] = $surah['audio'];
            Surah::create($surah);
            echo 'Surah ' . $surah['name_latin'] . " created successfully\n";
        }
        echo "========================All surah created successfully========================\n";
        echo "++++++++++++++++++++++++Begin fetch ayah++++++++++++++++++++++++\n";
    }

    /**
     * fetch list ayat
     *
     * @return void
     */
    private function fetchListAyat()
    {
        $surahs = Surah::all();
        foreach ($surahs as $surah) {
            $response = $this->client->request('GET', $this->host . 'quran/surah/' . $surah->number);
            $ayahs = json_decode($response->getBody()->getContents(), true);
            foreach ($ayahs['ayat'] as $ayah) {
                $ayah['number'] = $ayah['nomor'];
                $ayah['surah_id'] = $surah->id;
                $ayah['text_arabic'] = $ayah['ar'];
                $ayah['text_latin'] = $ayah['tr'];
                $ayah['text_id'] = $ayah['idn'];
                Ayah::create($ayah);
                echo 'Ayah ' . $ayah['number'] . ' from ' . $surah->name_latin . " created successfully\n";
            }
        }
        echo "========================All Ayah created successfully========================\n";
        echo "++++++++++++++++++++++++Successfully Scrape entire Qur'an++++++++++++++++++++++++\n";
    }
}
