<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SearchProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return response()->json([
        'status' => 200,
        'message' => 'success to get all products', 
        'products'=>Product::where('admins_id',Auth::user()->id)->get(),
      ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request)
    {
        $request->validate(['image' => 'required']);
        $data = $request->validated();
        $image = $request->validated('image');
        $data['admins_id'] = Auth::user()->id;
        $data['image'] = $image->store('product','public');
        $product = Product::create($data);
        return response()->json([
          'status' => 200,
          'message' => 'success to create product', 
          'products'=>$product,
        ],200);    
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
        return response()->json([
          'status' => 200,
          'message' => 'success to update product', 
          'products'=>$product,
        ],200);    
      }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();
        return response()->json([
          'status' => 200,
          'message' => 'success to delete product', 
        ],200);    
      }
}
