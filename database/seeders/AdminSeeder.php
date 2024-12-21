<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
          ['Marcel J. DJIOFACK','Shingeki no Kyojin','djiofackjason57@gmail.com','marcel.jpg','1234'],
          ['Bouonou cicero','Kō no Kyojin','bounoucicero@gmail.com','cicero.jpg','1111'],
          ['CHOUNA Lucresse','Onna-gata no Kyojin','lucressechouna640@gmail.com','lucresse.jpg','2222'],
          ['LONKENG grace','Agito no Kyojin','lonkenggrace@gmail.com','grace.jpg','3333'],
          ['ZEBAZE julie','Sentsui no Kyojin','zebazejulie6@gmail.com','julie.jpg','4444']
      ];

      foreach ($admin as $key => $super_user) {
        Admin::factory()->create([
            "name"=>$super_user[0],
            "nametitan"=>$super_user[1],
            "email"=>$super_user[2],
            "image"=>$super_user[3],
            "password"=> Hash::make($super_user[4])
        ]);
    }
    }
}
