<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $cities = ['Dscang,Cameroun','Bafoussam,Cameroun','Yaounde,Cameroun','Douala,Cameroun','Bertoua,Cameroun'];
      foreach ($cities as $key => $city) {
        City::factory()->create([
            "name"=> $city
        ]);
    }
    }
}
