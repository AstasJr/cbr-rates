<?php

namespace App\Jobs;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class FetchAndStoreCurrencies implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    /**
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $currentDate = date('d/m/Y');
        $url = "https://www.cbr.ru/scripts/XML_daily.asp?date_req={$currentDate}";

        $client = new Client();
        $response = $client->get($url);
        $xml = simplexml_load_string($response->getBody()->getContents());

        foreach ($xml->Valute as $valute) {
            $id = (string)$valute['ID'];
            $code = (string)$valute->CharCode;
            $name = (string)$valute->Name;

            $existingCurrency = DB::table('currencies')->where('code', $code)->first();

            if (!$existingCurrency) {
                DB::table('currencies')->updateOrInsert(
                    ['id' => $id],
                    ['code' => $code, 'name' => $name]
                );
            }
        }

    }
}
