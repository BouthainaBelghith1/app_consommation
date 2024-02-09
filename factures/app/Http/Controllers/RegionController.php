<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegionRequest;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function GetRegion()
    {
        $regions = Region::all();
        return response()->json(["data"=>$regions],200);
    }


   
    public function store(RegionRequest $request)
    {
        Region::create([
            "nomRegion"=>$request->nomRegion,
            "local_id"=>$request->local_id,
            "user_id"=>$request->user_id
        ]);

        return response()->json(["message"=>"Region Created"],201);
    }
   

    public function finById($id)
    {
        $region=Region::find($id);
        if($region){
            return response()->json(["data"=>$region],200);
        }else{
            return response()->json(["message"=>"Region Not Found"],404);
        }
    }


    public function update(RegionRequest $request, $id)
    {

        $region = Region::find($id);
        if($region){

            $region->update([
                "nomRegion"=>$request->nomRegion,
                "user_id"=>$request->user_id
            ]);

            return response()->json(["message"=>"Region Updated"],200);

        }else{
            return response()->json(["message"=>"Region Not Found"],404);
        }

    }

    public function destroy($id)
    {
        $region = Region::find($id);
        if($region){
            $region->delete();
            return response()->json(["message"=>"Delete With Success"],200);
        }else{
            return response()->json(["message"=>"Region Not Found"],404);
        }
    }
}
