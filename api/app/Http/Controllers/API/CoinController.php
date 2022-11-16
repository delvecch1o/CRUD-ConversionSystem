<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as HttpClient;
use App\Models\Coin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CoinController extends Controller
{
    public function coin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'submitIn'=>'required|integer',
            'submitFrom'=>'required|string|in:usd,eur,brl|different:submitTo',
            'submitTo'=>'required|string|in:usd,eur,brl'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }

        $in = $request->input('submitIn');
        $from = $request->input('submitFrom');
        $to = $request->input('submitTo');
        
        $httpClient = new HttpClient([ 'verify' => false ]);
        $data = json_decode($httpClient->get("https://economia.awesomeapi.com.br/${from}-${to}")
        ->getBody()->getContents());
        $result = $data[0]->bid * $in;

        $user = Auth::user();
        $user->coin()->create([
            'in'=>$in,
            'from'=>$from,
            'to'=>$to,
            'result'=>$result,
        ]);
        return response()->json(["result"=> $result]);

    }
    
}
