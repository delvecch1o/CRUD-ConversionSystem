<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ConversionService\AwesomeApi;




class CoinController extends Controller
{
    private AwesomeApi $awesomeApi;

    public function __construct(AwesomeApi $awesomeApi)
    {
        $this->awesomeApi = $awesomeApi;
    }

    public function coin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'submitIn' => 'required|integer',
            'submitFrom' => 'required|string|in:usd,eur,brl|different:submitTo',
            'submitTo' => 'required|string|in:usd,eur,brl'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        $result = $this->awesomeApi->coinService(
            ...array_values(
                $request->only([
                    'submitIn',
                    'submitFrom',
                    'submitTo',

                ])
            )
        );
        return response()->json([
            'status' => 200,
            'result' => $result['result'],

        ]);
    }

    public function show()
    {

        $historicCoin = $this->awesomeApi->showService();

        return response()->json([
            'historicCoin' => $historicCoin,
        ]);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'submitIn' => 'required|integer',
            'submitFrom' => 'required|string|in:usd,eur,brl|different:submitTo',
            'submitTo' => 'required|string|in:usd,eur,brl'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        $result = $this->awesomeApi->updateService(
            ...[$id, ...array_values(
                $request->only([
                    'submitIn',
                    'submitFrom',
                    'submitTo',


                ])
            )]
        );
        return response()->json([
            'status' => 200,
            'result' => $result['result'],

        ]);
    }

    public function destroy($id)
    {
        $this->awesomeApi->destroyService($id);
        return response()->json([
            'apagou' => "Foi excluido com sucesso"
        ]);
    }
}
