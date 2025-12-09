<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Article::factory()->count(20)->create(); 
    // Esto creará 20 artículos; cada uno vinculado a un usuario gracias 
    // al user_id en la factory.
    }
}


// seeder sirve para meter registros en la tabla, insertar filas.