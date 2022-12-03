<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ConversionService\AwesomeApi;
use App\Http\Requests\CoinRequest;


class CoinController extends Controller
{
    private AwesomeApi $awesomeApi;

    public function __construct(AwesomeApi $awesomeApi)
    {
        $this->awesomeApi = $awesomeApi;
    }

    public function coin(CoinRequest $request)
    {
      
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

    public function update(CoinRequest $request, $id)
    {

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
