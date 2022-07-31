<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
    
        DB::table('products')->insert([
            'name'=>'products 1',
            'stock'=> 15,
            'price'=>4.5,
            'created_at'=> new DateTime(),
        ]);

        
        DB::table('products')->insert([
            'name'=>'products 2',
            'stock'=> 18,
            'price'=>10,
            'created_at'=> new DateTime(),
        ]);

        
        DB::table('products')->insert([
            'name'=>'products 3',
            'stock'=> 28,
            'price'=>15,
            'created_at'=> new DateTime(),
        ]);
    }
}
