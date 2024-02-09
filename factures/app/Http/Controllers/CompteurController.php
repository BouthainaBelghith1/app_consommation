<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompteurRequest;
use App\Models\Compteur;
use Illuminate\Http\Request;

class CompteurController extends Controller
{
    public function GetCompteur()
    {
        $compteurs = Compteur::all();
        return response()->json(["data"=>$compteurs],200);
    }

    public function store(CompteurRequest $request)
    {
        $unite = '';

        switch ($request->type) {
            case 'gaz':
                $unite = 'm3';
                break;
            case 'eau':
                $unite = 'm3';
                break;
            case 'électricité':
                $unite = 'kWh';
                break;
            case 'internet':
                $unite = 'Mbps';
                break;
            default:
                $unite = "";
                break;
        }
        
        Compteur::create([
            'consommation' => 0,
            'numSerie' => $request->numSerie,
            'modele' => $request->modele,
            'unite' => $unite,
            'type' => $request->type,
            'local_id' => $request->local_id,
        ]);

        return response()->json(["message"=>"Compteur Created"],201);
    }
 
    public function finById($id)
    {
        $compteur=Compteur::find($id);
        if($compteur){
            return response()->json(["data"=>$compteur],200);
        }else{
            return response()->json(["message"=>"Region Not Found"],404);
        }
    }

    public function update(CompteurRequest $request, $id)
    {

        $compteur = Compteur::find($id);
        if($compteur){

            $compteur->update([
                'consommation' => $request->consommation,
                'numSerie' => $request->numSerie,
                'modele' => $request->modele,
                'unite' => $request->unite,
                'type' => $request->type,
                'local_id' => $request->local_id,
            ]);

            return response()->json(["message"=>"compteur Updated"],200);

        }else{
            return response()->json(["message"=>"compteur Not Found"],404);
        }
    }

    
    public function destroy($id)
    {
        $compteur = Compteur::find($id);
        if($compteur){
            $compteur->delete();
            return response()->json(["message"=>"Delete With Success"],200);
        }else{
            return response()->json(["message"=>"compteur Not Found"],404);
        }
    }

    public function countCompteurs()
    {
        $count = Compteur::count();
        return response()->json(['count' => $count]);
    }

    public function getTotalConsommationByMonthAndType($month, $type)
    {
        $totalConsommation = Compteur::where('type', $type)
            ->whereMonth('created_at', $month)
            ->sum('consommation');

        return response()->json(['sum' => $totalConsommation]);
    }

    public function getCountByMonth()
    {
        $counts = [
            'internet' => [],
            'eau' => [],
            'electricite' => [],
            'gaz' => [],
        ];

        for ($month = 1; $month <= 12; $month++) {
            $counts['internet'][] = Compteur::where('type', 'internet')
                ->whereMonth('created_at', $month)
                ->count();

            $counts['eau'][] = Compteur::where('type', 'eau')
                ->whereMonth('created_at', $month)
                ->count();

            $counts['electricite'][] = Compteur::where('type', 'électricité')
                ->whereMonth('created_at', $month)
                ->count();

            $counts['gaz'][] = Compteur::where('type', 'gaz')
                ->whereMonth('created_at', $month)
                ->count();
        }

        return response()->json($counts);
    }

    public function totalConsommation()
    {
        $counts = [
            'internet' => [],
            'eau' => [],
            'electricite' => [],
            'gaz' => [],
        ];

        for ($month = 1; $month <= 12; $month++) {
            $counts['internet'][] = Compteur::where('type', 'internet')
                ->whereMonth('created_at', $month)
                ->sum('consommation');

            $counts['eau'][] = Compteur::where('type', 'eau')
                ->whereMonth('created_at', $month)
                ->sum('consommation');

            $counts['electricite'][] = Compteur::where('type', 'électricité')
                ->whereMonth('created_at', $month)
                ->sum('consommation');

            $counts['gaz'][] = Compteur::where('type', 'gaz')
                ->whereMonth('created_at', $month)
                ->sum('consommation');
        }

        return response()->json($counts);
    }




    /*public function countCompteursByLocal($localId)
    {
        $count = Compteur::where('local_id', $localId)->count();
        return response()->json(['count' => $count]);
    }
    

    public function getConsommationTotale()
    {
        $compteurs = Compteur::all();
        $consommationTotale = $compteurs->sum('moyConsommation');
        
        return response()->json(['moyConsommation' => $consommationTotale]);
    }

    public function getMoyConsommation(request $request){
        
    }*/
}
