<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class HomeProductController extends Controller
{
    public function home():JsonResponse{
      try{
        return response()->json([
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
            'bestAccessories'=>Product::where('categories_id',4)
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
        ],200);
      }catch(\Exception $e){
        return response()->json($e);
      }
    }
    public function index():JsonResponse{ 
      return response()->json([
        'status' => 200,
        'message' => 'success to get all products', 
        'products'=>Product::all(),
      ],200);
    }
    public function show(Product $product):JsonResponse{
      return response()->json([
        'status' => 200,
        'message' => 'success to get an article', 
        'product'=>$product,
      ],200);  
    } 
}

