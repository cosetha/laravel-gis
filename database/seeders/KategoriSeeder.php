<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
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
            'gambar' => 'default.jpg'            
        ]);
        DB::table('kategori')->insert([
            'nama' => 'Wisata Kuliner', 
            'gambar' => 'default.jpg'             
        ]);
        DB::table('kategori')->insert([
            'nama' => 'Wisata Budaya',  
            'gambar' => 'default.jpg'            
        ]);
    }
}
