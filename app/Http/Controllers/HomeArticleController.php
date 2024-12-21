<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchArticleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Article;
use App\Models\Ville;
use Illuminate\Support\Facades\Hash;

class HomeArticleController extends Controller
{

    public function home(){
        return view('article.home',[
            'bestMangas'=>Article::where('categories_id',1)->orderByDesc('note')->limit(4)->get(),
            'bestFigurines'=>Article::where('categories_id',2)->orderByDesc('note')->limit(4)->get(),
            'bestHabits'=>Article::where('categories_id',3)->orderByDesc('note')->limit(4)->get(),
            'bestAccesoires'=>Article::where('categories_id',4)->orderByDesc('note')->limit(4)->get(),
            'bestSons'=>Article::where('categories_id',5)->orderByDesc('note')->limit(4)->get(),
            'bestGame'=>Article::where('categories_id',6)->orderByDesc('note')->limit(4)->get(),
            'categories'=>Categorie::all()
        ]);
    }
    public function index(){ 
        return view('article.index',[
            'articles'=>Article::paginate(8),
        ]);
    }
    
    // public function filter($id){
        // $query = Article::query();
        // if($request->has('searchValue')){
        //     $query = $query->where('name', 'like' ,"%{$request->input('searchValue')}%");
        // }
        // return view('article.index',[
        //     'articles'=>$query->where('categories_id',$id)->paginate(9),
        //     'categories'=>Categorie::all(),
        //     'filter_title'=>Categorie::findOrFail($id)->name
        // ]);
    // }

    public function show(Article $article){

        // $expectedSlug =  $article->getSlug();
        // if($slug != $expectedSlug){
        //     return to_route('client.article.show',[
        //         'slug'=>$expectedSlug,
        //         'article'=>$article
        //     ]);
        // }

        // dd('je passe dans show');

        return view('article.show',[
            'article'=>$article,
        ]);
    } 
}
