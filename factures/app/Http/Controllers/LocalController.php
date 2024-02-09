<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocalRequest;
use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    public function GetLocal()
    {
        $locals = Local::all();
        return response()->json(["data"=>$locals],200);
    }


    public function store(LocalRequest $request)
    {

        Local::create([
            'nomLocal' => $request->nomLocal,
            'adresseLocal' => $request->adresseLocal,
            'categorie_id' => $request->categorie_id,
        ]);

        return response()->json(["message"=>"Local Created"],201);
    }
 
    public function finById($id)
    {
        $local=Local::find($id);
        if($local){
            return response()->json(["data"=>$local],200);
        }else{
            return response()->json(["message"=>"local Not Found"],404);
        }
    }

    public function update(LocalRequest $request, $id)
    {
        $local = Local::find($id);
        if($local){

            $local->update([
                'nomLocal' => $request->nomLocal,
            ]);

            return response()->json(["message"=>"local Updated"],200);

        }else{
            return response()->json(["message"=>"local Not Found"],404);
        }
    }

    public function destroy($id)
    {
        $local = Local::find($id);
        if($local){
            $local->delete();
            return response()->json(["message"=>"Delete With Success"],200);
        }else{
            return response()->json(["message"=>"local Not Found"],404);
        }
    }

    public function countLocals()
    {
        $count = Local::count();
        return response()->json(['count' => $count]);
    }

    /*public function filtrer($region_id)
    {
        $locals = Local::where('region_id', $region_id)->get();

        return response()->json(['data' => $locals], 200);
    }*/
}
