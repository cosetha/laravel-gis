<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert([
            'nama' => 'Wisata Alam',            
        ]);
        DB::table('kategori')->insert([
            'nama' => 'Wisata Kuliner',            
        ]);
        DB::table('kategori')->insert([
            'nama' => 'Wisata Budaya',            
        ]);
    }
}
