<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartUpdateRequest;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Product;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index():JsonResponse{
    return response()->json([
      'carts' => Cart::where('user_id',Auth::user()->id)
                        ->with(['product','city'])->orderBy('city_id')
                        ->get(),
    ],200);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request,Product $product):JsonResponse
  {
    $user = Auth::user();
    $myCart = Cart::where('product_id',$product->id)
                        ->where('user_id',$user->id)
                        ->get();
    $message = 'the product has been added to the cart';
    if($myCart->isEmpty()){
      $newCart = new Cart();
      $newCart->user_id = $user->id;
      $newCart->product_id = $product->id;
      $newCart->city_id = $user->city_id;
      $newCart->save();
      $myCart = $newCart;
    }else{
      $myCart[0]->quantity += 1;
      $myCart[0]->save();
      $message = 'the product quantity has been added';
    }

    return response()->json([
      'status' => 200,
      'message' => $message,
      'carts' => $myCart
    ],200);
  }
    public function update(CartUpdateRequest $request,Cart $cart){
      try{
        $data=$request->validated();
        // $data = $request->all();
        $cart->quantity=$data['quantity'];
        $cart->city_id=$data['city_id'];
        $cart->save();
        return response()->json([
          'status' => 200,
          'message' => 'the product quantity has been updated',
          'carts' => $cart
        ],200);
      }catch(\Exception $e){
        return response()->json($e);
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return response()->json([
          'status' => 200,
          'message' => 'the product has been removed from the cart',
        ],200);
      }

      public function destroyAll(){
        Cart::query()->delete();
        return response()->json([
          'status' => 200,
          'message' => 'all products have been removed from the cart',
        ],200);
    }
}
