<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\panier;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FactureController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prixTotal=0;
        $quantiteTotal=0;
        $user = Auth::user();
        $paniers=Panier::where('user_id',$user->id)->get();
        $factures = [];

        foreach($paniers as $panier ){
          $facture=new Facture();
          $facture->user_id = $user->id;
          $facture->panier_id = $panier->id;
          $prixTotal += $facture->panier->product->price * $facture->panier->quantite;
          $quantiteTotal += $facture->panier->quantite;
          $factures[] = $facture;
        }
        $villes = Ville::orderBy('id')->get();
        return view('facture.index',compact('villes','factures','prixTotal','quantiteTotal'));
    }


    public function sorry()
    {
        return view('facture.sorry');
    }

}
