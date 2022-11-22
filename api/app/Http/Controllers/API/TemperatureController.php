<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ConversionService\TemperaturaApi;

class TemperatureController extends Controller
{
    private TemperaturaApi $temperaturaApi;

    public function __construct(TemperaturaApi $temperaturaApi)
    {
        $this->temperaturaApi = $temperaturaApi;
    }

    public function temperature(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'submitIn' => 'required|integer',
            'submitFrom' => 'required|string|in:celsius,fahrenheit,kelvin|different:submitTo',
            'submitTo' => 'required|string|in:celsius,fahrenheit,kelvin'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

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


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'submitIn' => 'required|integer',
            'submitFrom' => 'required|string|in:celsius,fahrenheit,kelvin|different:submitTo',
            'submitTo' => 'required|string|in:celsius,fahrenheit,kelvin'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

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

    public function destroy($id)
    {
        $this->temperaturaApi->destroyService($id);
        return response()->json([
            "message" => "Foi excluido com sucesso"
        ]);
    }
}
