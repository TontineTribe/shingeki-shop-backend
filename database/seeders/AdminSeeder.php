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
        $admins = [
          ['Marcel J. DJIOFACK','Shingeki no Kyojin','marceldjiofack@outlook.com','/images/admin/marcel.jpg','12345678'],
          ['Bouonou cicero','Kō no Kyojin','bounoucicero@gmail.com','/images/admin/cicero.jpg','11111111'],
          ['CHOUNA Lucresse','Onna-gata no Kyojin','lucressechouna640@gmail.com','/images/admin/lucresse.jpg','22222222'],
          ['LONKENG grace','Agito no Kyojin','lonkenggrace@gmail.com','/images/admin/grace.jpg','33333333'],
          ['ZEBAZE julie','Sentsui no Kyojin','zebazejulie6@gmail.com','/images/admin/julie.jpg','44444444'],
          ['SOH TALOTSING DUCLAIR','Chō-ōgata Kyojin','sohduclair1@gmail.com','/images/admin/duclair.jpg','55555555'],
          ['MENGUE ONDOUA Kerane','Shiso no Kyojin','keraneondoua14@gmail.com','/images/admin/kerane.jpg','66666666'],
          ['NGANSOP Martial','Kemono no Kyojin','martialngansop4@gmail.com','/images/admin/martial.jpg','77777777'],
          ['PELAP AMELIE-LAURE','Shariki no Kyojin','pelapamelie@gmail.com','/images/admin/amelie.jpg','88888888'],
          ['WAKAM Yann','Boranto no kyojin','wakamkyannb04@gmail.com','/images/admin/yann.jpg','99999999'],
      ];

      foreach ($admins as $key => $admin) {
        Admin::factory()->create([
            "name"=>$admin[0],
            "nametitan"=>$admin[1],
            "email"=>$admin[2],
            "image"=>$admin[3],
            "password"=> Hash::make($admin[4])
        ]);
    }
    }
}
