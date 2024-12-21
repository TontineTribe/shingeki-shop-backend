<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleFormRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.articles.index',[
            'articles'=>Article::orderByDesc('created_at')->paginate(8),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.articles.form',[
            'article' => new Article(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleFormRequest $request)
    {
        $data = $request->validated();
        $image = $request->validated('imagearticle');
        $data['imagearticle'] = $image->store('article','public');
        $article = Article::create($data);
        return to_route('admin.article.index')->with('success','le bien a ete cree');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('admin.articles.form',[
            'article' => $article,
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleFormRequest $request, Article $article)
    {
        $data = $request->validated();
        $image = $request->validated('imagearticle');
        $data['imagearticle'] = $image->store('article','public');
        // Storage::disk('public')->delete($article->image);
        $article->update($data);
        return to_route('admin.article.index')->with('success','le bien a ete mis a jour');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Storage::disk('public')->delete($article->image);
        $article->delete();
        return to_route('admin.article.index')->with('success','le bien a ete supprimer');
    }
}
