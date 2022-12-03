<?php

namespace App\Services\ConversionService;

use Illuminate\Support\Facades\Auth;
use App\Models\Temperature;


class TemperaturaApi
{
    public function temperaturaService($in, $from, $to)
    {

        if ($from == 'celsius') {
            if ($to == 'fahrenheit') {
                $result = number_format(($in * 9) / 5 + 32, 2);
            } elseif ($to == 'kelvin') {
                $result = number_format($in + 273.15, 2);
            }
        } elseif ($from == 'fahrenheit') {
            if ($to == 'celsius') {
                $result =  number_format(($in - 32) * 5 / 9, 2);
            } elseif ($to == 'kelvin') {
                $result = number_format((($in - 32) * 5 / 9) + 273.15, 2);
            }
        } elseif ($from == 'kelvin') {
            if ($to == 'celsius') {
                $result = number_format($in - 273.15, 2);
            } elseif ($to == 'fahrenheit') {
                $result = number_format((($in - 273.15) * 9 / 5) + 32, 2);
            }
        }

        $user = Auth::user();
        $user->temperature()->create([
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
        $historicTemperature = $user->temperature()->get();

        return [
            'historicTemperature' => $historicTemperature,
        ];
    }

    public function updateService($id, $in, $from, $to)
    {
        
        if ($from == 'celsius') {
            if ($to == 'fahrenheit') {
                $result = number_format(($in * 9) / 5 + 32, 2);
            } elseif ($to == 'kelvin') {
                $result = number_format($in + 273.15, 2);
            }
        } elseif ($from == 'fahrenheit') {
            if ($to == 'celsius') {
                $result =  number_format(($in - 32) * 5 / 9, 2);
            } elseif ($to == 'kelvin') {
                $result = number_format((($in - 32) * 5 / 9) + 273.15, 2);
            }
        } elseif ($from == 'kelvin') {
            if ($to == 'celsius') {
                $result = number_format($in - 273.15, 2);
            } elseif ($to == 'fahrenheit') {
                $result = number_format((($in - 273.15) * 9 / 5) + 32, 2);
            }
        }
        
        $user = Auth::user();
        $user->temperature()->where('id', $id)->update([
            'in' => $in,
            'from' => $from,
            'to' => $to,
            'result' => $result,
        ]);

        return [
            'result' => $result
        ];
    }

    public function destroyService(Temperature $temperature)
    {
        $temperature->delete();
    }
}
