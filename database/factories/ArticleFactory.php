<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'title'   => $this->faker->sentence(4),      // Título falso
            'content' => $this->faker->paragraph(3),     // Contenido falso
            'user_id' => User::factory(),                // Crea un usuario y lo asocia
        ];
    }
}

// sirve para definir la plantilla del un modelo falso, no inserta nada solo genera artículo falso
// faker es una librería que genera datos falsos pero creibles.