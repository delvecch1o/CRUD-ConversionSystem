<?php

namespace App\Services\ConversionService;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as HttpClient;
use App\Models\Coin;
use Illuminate\Support\Facades\Auth;

class AwesomeApi
{
    public function coinService($in, $from, $to)
    {

        $httpClient = new HttpClient(['verify' => false]);
        $data = json_decode($httpClient->get("https://economia.awesomeapi.com.br/${from}-${to}")
            ->getBody()->getContents());
        $result = $data[0]->bid * $in;

        $user = Auth::user();
        $user->coin()->create([
            'in' => $in,
            'from' => $from,
            'to' => $to,
            'result' => $result,
        ]);
        return [
            'result' => $result
        ];
    }

    public function showService()
    {
        $user = Auth::user();
        $historicCoin = $user->coin()->get();

        return [

            'historicCoin' => $historicCoin,
        ];
    }

    public function updateService($id, $in, $from, $to)
    {

        $httpClient = new HttpClient(['verify' => false]);
        $data = json_decode($httpClient->get("https://economia.awesomeapi.com.br/${from}-${to}")
            ->getBody()->getContents());
        $result = $data[0]->bid * $in;

        $user = Auth::user();
        $user->coin()->where('id', $id)->update([
            'in' => $in,
            'from' => $from,
            'to' => $to,
            'result' => $result,
        ]);
        return [
            'result' => $result
        ];
    }

    public function destroyService($id)
    {
        Coin::findOrFail($id)->delete();
    }
}
