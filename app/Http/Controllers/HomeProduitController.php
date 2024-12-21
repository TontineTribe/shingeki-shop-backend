<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchProductRequest;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Ville;
use Illuminate\Support\Facades\Hash;

class HomeProduitController extends Controller
{

    public function home(){
        return view('product.home',[
            'bestMangas'=>Product::where('categories_id',1)
                                  ->orderByDesc('note')
                                  ->orderByDesc('nb_vote')
                                  ->limit(4)
                                  ->get(),
            'bestFigurines'=>Product::where('categories_id',2)
                                    ->orderByDesc('note')
                                    ->orderByDesc('nb_vote')
                                    ->limit(4)
                                    ->get(),
            'bestHabits'=>Product::where('categories_id',3)
                                  ->orderByDesc('note')
                                  ->orderByDesc('nb_vote')
                                  ->limit(4)
                                  ->get(),
            'bestAccesoires'=>Product::where('categories_id',4)
                                      ->orderByDesc('note')
                                      ->orderByDesc('nb_vote')
                                      ->limit(4)
                                      ->get(),
            'bestSons'=>Product::where('categories_id',5)
                                ->orderByDesc('note')
                                ->orderByDesc('nb_vote')
                                ->limit(4)
                                ->get(),
            'bestGame'=>Product::where('categories_id',6)
                              ->orderByDesc('note')
                              ->orderByDesc('nb_vote')
                              ->limit(4)
                              ->get(),
            'categories'=>Categorie::all()
        ]);
    }
    public function index(SearchProductRequest $request){ 
        $query = Product::query();
        if($request->has('searchValue')){
            $query = $query->where('name', 'like' ,"%{$request->input('searchValue')}%");
        }
        return view('product.index',[
            'products'=>$query->paginate(9),
            'categories'=>Categorie::all(),
            'filter_title'=>'Produits'
        ]);
    }

    public function filter($id,SearchProductRequest $request){
        $query = Product::query();
        if($request->has('searchValue')){
            $query = $query->where('name', 'like' ,"%{$request->input('searchValue')}%");
        }
        return view('product.index',[
            'products'=>$query->where('categories_id',$id)->paginate(9),
            'categories'=>Categorie::all(),
            'filter_title'=>Categorie::findOrFail($id)->name
        ]);
    }

    public function show(string $slug, Product $product,SearchProductRequest $request){
        if($request->has('searchValue')){
            $query = Product::query();
            $query = $query->where('name', 'like' ,"%{$request->input('searchValue')}%");
            return view('product.index',[
                'products'=>$query->where('categories_id',$product->categories_id)->paginate(9),
                'categories'=>Categorie::all(),
                'filter_title'=>Categorie::findOrFail($product->categories_id)->name
            ]);
        }
        $expectedSlug =  $product->getSlug();
        if($slug != $expectedSlug){
            return to_route('client.product.show',[
                'slug'=>$expectedSlug,
                'product'=>$product
            ]);
        }


        return view('product.show',[
            'product'=>$product,
            'categories'=>Categorie::all(),
            'villes'=>Ville::all(),
            'products'=>Product::where('categories_id',$product->categories_id)
                                ->get()
                                ->random(4),
            'filter_title'=>Categorie::findOrFail($product->categories_id)->name,
        ]);
    } 
}
