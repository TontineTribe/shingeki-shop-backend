<?php

namespace Database\Seeders;

use App\Models\Ville;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $villes = ['Dscang,Cameroun','Bafoussam,Cameroun','Yaounde,Cameroun','Douala,Cameroun','Bertoua,Cameroun'];
      foreach ($villes as $key => $value) {
        Ville::factory()->create([
            "name"=> $value
        ]);
    }
    }
}
