<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductFormRequest;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SearchProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchProductRequest $request)
    {
        $query = Product::query();
        if($request->has('searchValue')){
            $query = $query->where('name', 'like' ,"%{$request->input('searchValue')}%");
        }
        return view('admin.products.index',[
            'products'=>$query->orderByDesc('created_at')->paginate(9),
            'categories'=>Categorie::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product =new Product();
        return view('admin.products.form',[
            'product' => $product,
            'categories' => Categorie::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request)
    {
        $request->validate(['image' => 'required']);
        $data = $request->validated();
        $image = $request->validated('image');
        $data['image'] = $image->store('product','public');
        $product = Product::create($data);
        return to_route('admin.product.index')->with('success','le produit a ete cree');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.form',[
            'product' => $product,
            'categories' => Categorie::all()
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, Product $product)
    {
        $data = $request->validated();
        $image = $request->validated('image');

        if(isset($image)){
          $data['image'] = $image->store('product','public');
          Storage::disk('public')->delete($product->image);
        }
        
        $product->update($data);
        return to_route('admin.product.index')->with('success','le produit a ete mis a jour');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();
        // return to_route('admin.product.index')->with('success','le produit a ete supprimer');
        session()->flash('success','le produit a ete supprimer');
        return response()->json();
    }
}
