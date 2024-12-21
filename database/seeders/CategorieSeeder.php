<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $categories = ["Mangas","Figurines","Habits","Accessoires","Sons","Jeux Videos"];
      foreach ($categories as $key => $value) {
        Categorie::factory()->create([
            "name"=> $value
        ]);
    }
    }
}
