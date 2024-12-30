<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleFormRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return response()->json([
        'status' => 200,
        'message' => 'success to get all article', 
        'articles'=>Article::where('admins_id',Auth::user()->id)->get(),
      ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleFormRequest $request)
    {
        $request->validate(['image' => 'required']);
        $data = $request->validated();
        $image = $request->validated('image');
        $data['image'] = $image->store('article','public');
        $data['admins_id'] = Auth::user()->id;
        $article = Article::create($data);
        return response()->json([
          'status' => 200,
          'message' => 'success to create article', 
          'products'=>$article,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleFormRequest $request, Article $article)
    {
        $data = $request->validated();
        $image = $request->validated('image');
        if(isset($image)){
          $data['image'] = $image->store('article','public');
          Storage::disk('public')->delete($article->image);
        }
        
        $article->update($data);
        return response()->json([
          'status' => 200,
          'message' => 'success to update article', 
          'products'=>$article,
        ],200);    
      }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
      Storage::disk('public')->delete($article->image);
      $article->delete();
      return response()->json([
        'status' => 200,
        'message' => 'success to delete article', 
      ],200); 
    }
}
