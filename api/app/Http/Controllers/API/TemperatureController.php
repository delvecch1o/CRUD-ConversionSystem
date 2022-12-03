<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ConversionService\TemperaturaApi;
use App\Http\Requests\TemperatureRequest;
use App\Models\Temperature;

class TemperatureController extends Controller
{
    private TemperaturaApi $temperaturaApi;

    public function __construct(TemperaturaApi $temperaturaApi)
    {
        $this->temperaturaApi = $temperaturaApi;
    }

    public function temperature(TemperatureRequest $request)
    {
       
        $result = $this->temperaturaApi->temperaturaService(
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

        $historicTemperature = $this->temperaturaApi->showService();
        return response()->json([
            'historicTemperature' => $historicTemperature,
        ]);
    }


    public function update(TemperatureRequest $request, $id)
    {
        

        $result = $this->temperaturaApi->updateService(
            ...[$id, ...array_values(
                $request->only([
                    'submitIn',
                    'submitFrom',
                    'submitTo'
                ])
            )]
        );
        return response()->json([
            'status' => 200,
            'result' => $result['result']
        ]);
    }

    public function destroy(Temperature $temperature)
    {
        $this->temperaturaApi->destroyService($temperature);
        return response()->json([
            "message" => "Foi excluido com sucesso"
        ]);
    }
}
