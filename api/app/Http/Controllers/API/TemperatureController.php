<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Temperature;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TemperatureController extends Controller
{
    public function temperature(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'submitIn'=>'required|integer',
            'submitFrom'=>'required|string|in:celsius,fahrenheit,kelvin|different:submitTo',
            'submitTo'=>'required|string|in:celsius,fahrenheit,kelvin'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }

        $in = $request->input('submitIn');
        $from = $request->input('submitFrom');
        $to = $request->input('submitTo');
       // dd($from,$to,$request->all(),$validator->validated());
        if($from == 'celsius')
           {
               if ($to == 'fahrenheit') {
                $result = number_format (($in * 9) /5 + 32 , 2);
               }
               elseif ($to =='kelvin') {
                $result = number_format ($in + 273.15 , 2); 
               }    
           } 
           elseif($from == 'fahrenheit')
           {
            if ($to == 'celsius') {
                $result =  number_format (($in - 32) * 5/9 , 2);
               }
               elseif ($to =='kelvin') {
                $result = number_format ((($in - 32) * 5/9) + 273.15 , 2);
               }    
            
           }
           elseif($from == 'kelvin')
           {
               if($to == 'celsius'){
                $result = number_format ($in - 273.15 , 2);
               }
               elseif($to == 'fahrenheit') {
                $result = number_format ((($in - 273.15) * 9/5) + 32 , 2);
               }
           }
           
           $user = Auth::user();
           $user->temperature()->create([
               'in'=>$in,
               'from'=>$from,
               'to'=>$to,
               'result'=>$result,
           ]);
       
       
       return response()->json(["result" => $result]);
    }

    public function show(){
        $user = Auth::user();
        $historicTemperature = $user->temperature()->get();

        return response()->json([
            'historicTemperature'=>$historicTemperature,
        ]);
    }

    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'submitIn'=>'required|integer',
            'submitFrom'=>'required|string|in:celsius,fahrenheit,kelvin|different:submitTo',
            'submitTo'=>'required|string|in:celsius,fahrenheit,kelvin'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }

        $in = $request->input('submitIn');
        $from = $request->input('submitFrom');
        $to = $request->input('submitTo');

        if($from == 'celsius')
        {
            if ($to == 'fahrenheit') {
             $result = number_format (($in * 9) /5 + 32 , 2);
            }
            elseif ($to =='kelvin') {
             $result = number_format ($in + 273.15 , 2); 
            }    
        } 
        elseif($from == 'fahrenheit')
        {
         if ($to == 'celsius') {
             $result =  number_format (($in - 32) * 5/9 , 2);
            }
            elseif ($to =='kelvin') {
             $result = number_format ((($in - 32) * 5/9) + 273.15 , 2);
            }    
         
        }
        elseif($from == 'kelvin')
        {
            if($to == 'celsius'){
             $result = number_format ($in - 273.15 , 2);
            }
            elseif($to == 'fahrenheit') {
             $result = number_format ((($in - 273.15) * 9/5) + 32 , 2);
            }
        }
        
        $user = Auth::user();
        $user->temperature()->where('id',$id)->update([
            'in'=>$in,
            'from'=>$from,
            'to'=>$to,
            'result'=>$result,
        ]);
    
    return response()->json(["result" => $result]);
 
    }

    public function destroy($id){
        Temperature::findOrFail($id)->delete();
        return response()->json([
            "message"=>"Foi excluido com sucesso"
        ]);
    }

}


