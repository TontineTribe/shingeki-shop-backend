<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $categories = ["Mangas","Figurines","Habits","Accessoires","Sons","Jeux Videos"];
      foreach ($categories as $key => $value) {
        Category::factory()->create([
            "name"=> $value
        ]);
    }
    }
}
