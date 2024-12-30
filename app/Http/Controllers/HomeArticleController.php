<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Category;
use App\Models\Article;

class HomeArticleController extends Controller
{
    public function index():JsonResponse{
      return response()->json([
        'status' => 200,
        'message' => 'success to get all articles', 
        'articles'=>Article::all(),
      ],200);    
    }

    public function show(Article $article):JsonResponse{
      return response()->json([
        'status' => 200,
        'message' => 'success to get an article', 
        'article'=>$article,
      ],200);  
    } 
}
