<?php

namespace App\Http\Controllers;

use App\Http\Requests\FactureRequest;
use App\Models\Compteur;
use App\Models\Facture;
use App\Models\Local;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\Fact;

class FactureController extends Controller
{
    public function GetFacture()
    {
        $factures = Facture::all();
        return response()->json(["data"=>$factures],200);
    }

    public function store(FactureRequest $request)
    {
        $periode = 1;
        $prixUnitaire = 1.0;
        $compteur = Compteur::findOrFail($request->compteur_id);
        if ($compteur->type === 'électricité' || $compteur->type === 'gaz') {
            $prixUnitaire = 231.0;
        } else if($compteur->type === 'internet'){
            $prixUnitaire = 350.0;
        } else if($compteur->type === 'eau'){
            $prixUnitaire = 665.0;
            $periode = 3;
        }

        $dateFinConsommation = now()->addMonths($periode);

        $consommation = $compteur->consommation;
        $derniereFacture = Facture::latest()->first();
        $quantiteDerniereFacture = $derniereFacture ? $derniereFacture->quantite : 0;

        $quantite = $consommation - $quantiteDerniereFacture;
        $montantTotal = ($quantite * $prixUnitaire) / 1000;

        $local = Local::findOrFail($compteur->local_id);
        $adresse = $local->adresseLocal;

        $dateLimitePaiement = $dateFinConsommation->addDays(15);

        $isPais = 0;
        
        Facture::create([
            'montantTotale' => $montantTotal,
            'isPaid' => $isPais,
            'periode' =>(int) $periode,
            'adresse' => $adresse,
            'dateFinConsommation' => $dateFinConsommation,
            'dateLimitePaiement' => $dateLimitePaiement,
            'prixUnitaire' => (float) $prixUnitaire,
            'quantite' => $quantite,
            'compteur_id' => $request->compteur_id,
        ]);


        return response()->json(["message"=>"Facture Created"],201);
    }
 
    public function finById($id)
    {
        $facture=Facture::find($id);
        if($facture){
            return response()->json(["data"=>$facture],200);
        }else{
            return response()->json(["message"=>"facture Not Found"],404);
        }
    }

    public function update(FactureRequest $request, $id)
    {

        $facture = Facture::find($id);
        if($facture){

            $facture->update([
                'prixUnitaire' => $request->prixUnitaire,
                'compteur_id' => $request->compteur_id,
            ]);
            return response()->json(["message"=>"facture Updated"],200);

        }else{
            return response()->json(["message"=>"facture Not Found"],404);
        }
    }


    public function destroy($id)
    {
        $facture = Facture::find($id);
        if($facture){
            $facture->delete();
            return response()->json(["message"=>"Delete With Success"],200);
        }else{
            return response()->json(["message"=>"facture Not Found"],404);
        }
    }

    public function payer($id){
        $facture = Facture::find($id);
        if($facture){
            $facture->update(['isPaid'=>1]);
            return response()->json(["message"=>"Payment Effectuée avec Succès"]);
        }else{
            return response()->json(["message"=>"La facture n'a pas été trouvé"]);
        }
    }

    public function countFactureNonPaye()
    {
        $count = Facture::where('isPaid', 0)->count();
        return response()->json(['count' => $count]);
    }

    public function countFacturePaye()
    {
        $count = Facture::where('isPaid', 1)->count();
        return response()->json(['count' => $count]);
    }

    public function countFacture()
    {
        $count = Facture::count();
        return response()->json(['count' => $count]);
    }

    /*public function getMontantTotal()
    {
        $factures = Facture::all();
        $montantTotal = $factures->sum('montantFacture');
        
        return response()->json(['montantFacture' => $montantTotal]);
    }*/
}
