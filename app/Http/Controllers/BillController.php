<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Cart;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create():JsonResponse
    {
        $totalPrice=0;
        $totalQuantity=0;
        $user = Auth::user();
        $carts=Cart::where('user_id',$user->id)->get();
        $bills = [];

        foreach($carts as $cart ){
          $bill=new Bill();
          $bill->user_id = $user->id;
          $bill->cart_id = $cart->id;
          $totalPrice += $bill->cart->product->price * $bill->cart->quantity;
          $totalQuantity += $bill->cart->quantity;
          $bills[] = $bill;
        }

        return response()->json([
          'status' => 200,
          'message' => 'the bill has been created',
          'bills' => $bills,
          'totalPrice' => $totalPrice,
          'totalQuantity' => $totalQuantity,
        ],200);
    }

}
