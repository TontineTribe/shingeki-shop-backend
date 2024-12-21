<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Panier;
use App\Models\Product;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PanierController extends Controller
{
  /**
   * Display a listing of the resource.
   */
    public function index(){
      return view('panier.index',[
        'paniers' => Panier::where('user_id',Auth::user()->id)->with(['product','ville'])->orderBy('ville_id')->get(),
        'villes' => Ville::all()
      ]);
    }

    public function getPaniers(){
      $prixTotal = 0;
      $quantiteTotal = 0;
      $paniersList = Panier::where('user_id',Auth::user()->id)->with(['product','ville'])->orderBy('ville_id')->get();
      foreach ($paniersList as $key => $panier) {
        $prixTotal += $panier->product->price * $panier->quantite;
        $quantiteTotal += $panier->quantite;
      }
      
      return response()->json([
        'paniersList' => $paniersList,
        'villes' => Ville::all(),
        'quantiteTotal' => $quantiteTotal,
        'prixTotal' => $prixTotal
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Product $product)
    {

      $user = Auth::user();
      $monPanier = Panier::where('product_id',$product->id)
                          ->where('user_id',$user->id)
                          ->get();

      if($monPanier->isEmpty()){
        $newPanier = new Panier();
        $newPanier->user_id = $user->id;
        $newPanier->product_id = $product->id;
        $newPanier->ville_id = $user->ville->id;
        $newPanier->save();
      }else{
        $monPanier[0]->quantite += 1;
        $monPanier[0]->save();
    }

}

    public function storeShow(Request $request,Product $product)
    {
      $data=$request->validate([
        'quantite'=>'required|min:1|integer',
        'ville_id'=>'required|exists:villes,id',
      ]);

      $user = Auth::user();
      $monPanier = Panier::where('product_id',$product->id)
                          ->where('user_id',$user->id)
                          ->get();

      if($monPanier->isEmpty()){
        $newPanier = new Panier();
        $newPanier->user_id = Auth::user()->id;
        $newPanier->product_id = $product->id;
        $newPanier->quantite = $data['quantite'];
        $newPanier->ville_id = $data['ville_id'];
        $newPanier->save();
      }else{
        $data['quantite'] > 1 ? $monPanier[0]->quantite = $data['quantite'] : $monPanier[0]->quantite +=1;
        $monPanier[0]->ville_id = $data['ville_id'];
        $monPanier[0]->save();
    }
    return redirect()->route('panier.index');

    }

    public function update(Request $request,Panier $panier){
      $data=$request->validate([
        'quantite'=>'required|min:1|integer',
        'ville_id'=>'required',
      ]);
      $panier->quantite=$data['quantite'];
      $panier->ville_id=$data['ville_id'];
      $panier->save();
      // return redirect()->route('panier.index');
      return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Panier $panier)
    {
        $panier->delete();
      }

      public function destroyAll(){
        Panier::query()->delete();
        return response()->json();
    }
}
