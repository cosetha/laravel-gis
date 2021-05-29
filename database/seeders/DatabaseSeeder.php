<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(UsersTableSeeder::class);
        $roles = \App\Models\Role::all();
        \App\Models\User::All()->each(function ($user) use ($roles){
            // $user->roles()->saveMany($roles);
            $user->roles()->attach(\App\Models\Role::where('name', 'admin')->first());
         });
        // \App\Models\User::all()->each(function ($user) use ($roles) { 
        //     $user->roles()->attach(
        //         $roles->random(rand(1, 2))->pluck('id')->toArray()
        //     ); 
        // });
    }
}
