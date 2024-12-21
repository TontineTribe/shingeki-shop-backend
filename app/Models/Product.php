<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    function category(){
        return $this->belongsTo(Categorie::class);
    }
    function user_note(){
        return $this->belongsToMany(User_Note::class);
    }
    function product_favori(){
        return $this->belongsToMany(Product_favori::class);
    }

    //helpers

    public function imageUrl(){
        return Storage::disk('public')->url($this->image);
    }

    public function getSlug():string{
        return Str::slug($this->name);
    }

    public function getPrice(){
        return number_format($this->price,0,' ',' ');
    }


}

