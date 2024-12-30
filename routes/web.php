<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ArticleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',function () {
    return view('base');
});