<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $users = [
        ['user1','697815095','user1@gmail.com','11111111'],
        ['user2','89898989','user2@gmail.com','22222222'],
        ['user3','89898989','user30@gmail.com','33333333'],
        ['user4','89898989','user4@gmail.com','44444444'],
        ['user5','89898989','user5@gmail.com','55555555']
      ];

      foreach ($users as $key => $user) {
        User::factory()->create([
            "name"=>$user[0],
            "phone"=>$user[1],
            "email"=>$user[2],
            "password"=> Hash::make($user[3]),
            // "nametitan"=>$user[4],
            // "image" => $user[4],
            "city_id" => City::all()->random()->id
        ]);
  }
    }
}
