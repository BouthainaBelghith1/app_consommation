<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieRequest;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function GetCategorie()
    {
        $categories = Categorie::all();
        return response()->json(["data"=>$categories],200);
    }

    public function store(CategorieRequest $request)
    {

        Categorie::create([
            "nomCategorie"=>$request->nomCategorie,
        ]);

        return response()->json(["message"=>"Categorie Created"],201);
    }

    public function finById($id)
    {
        $categorie=Categorie::find($id);
        if($categorie){
            return response()->json(["data"=>$categorie],200);
        }else{
            return response()->json(["message"=>"Categorie Not Found"],404);
        }
    }

    public function update(CategorieRequest $request, $id)
    {

        $categorie = Categorie::find($id);
        if($categorie){

            $categorie->update([
                "nomCategorie"=>$request->nomCategorie,
            ]);

            return response()->json(["message"=>"Categorie Updated"],200);

        }else{
            return response()->json(["message"=>"Categorie Not Found"],404);
        }
    }

    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        if($categorie){
            $categorie->delete();
            return response()->json(["message"=>"Delete With Success"],200);
        }else{
            return response()->json(["message"=>"Categorie Not Found"],404);
        }
    }
}
