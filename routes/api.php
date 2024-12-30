<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeProductController;
use App\Http\Controllers\HomeArticleController;  
use App\Http\Controllers\UserController;        


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//! redirect after fail to pass in protected routes
Route::get('/login',function () {
  return response()->json([
    "status"=>401,
    'message'=>'This route is protected by authentication'
  ],401);
})->name('login');

//? public routes
  // simple user register
  Route::post('/register',[UserController::class,'store']);
  // simple user login
  Route::post('/login',[UserController::class,'login']);

  // Admin login
  Route::post('/admin/login',[AdminController::class,'doLogin']);

  // get all products
  Route::get('/product', [HomeProductController::class,'index']);
  // get all best products for home
  Route::get('/product/home', [HomeProductController::class,'home']);
  // get one product
  Route::get('/product/{product}', [HomeProductController::class,'show']);

  // get all categories
  Route::get('/category', [CategoryController::class,'index']);

  // get all articles
  Route::get('/article', [HomeArticleController::class,'index']);
  // get one article
  Route::get('/article/{article}', [HomeArticleController::class,'show']);

//? protected by authentication  routes
  Route::middleware('auth:sanctum')->group(function(){
    // get user connect
    Route::get('/user', function (Request $request):User {
      return $request->user();
    });

    // user logout
    Route::delete('/logout',[UserController::class,'logout']);

    // index, store, update, destroy and destroy-all routes for cart
    // Route::resource('/cart',CartController::class)->except(['show','create','edit','store']);
    Route::get('/cart',[CartController::class,'index']);
    Route::post('/cart/{product}',[CartController::class,'store']);
    Route::put('/cart/{cart}',[CartController::class,'update']);
    Route::delete('/cart/{cart}',[CartController::class,'destroy']);
    Route::delete('/cart/destroy-all',[CartController::class,'destroyAll']);

    // create bill
    Route::get('/bill',[BillController::class,'create']);
    
    //? admin routes
    Route::prefix('/admin')->group(function (){
      // get admin connect
      Route::get('/', function (Request $request):JsonResponse {
        return response()->json(['admin'=>auth()->user()]);
      });

      // admin logout
      Route::delete('/logout',[AdminController::class,'logout']);
    
      // index, store, update and destroy routes for product
      Route::resource('/product',ProductController::class)->except(['show','create','edit']);

      // index, store, update and destroy routes for article
      Route::resource('/article',ArticleController::class)->except(['show','create','edit']);
    });
  });
