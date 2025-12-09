<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;

class ArticlesController extends Controller
{
    public function testQueries()
    {
        //Obtener todos los artículos
        $allArticles = Article::all();

        //Buscar un artículo concreto (por ID)
        $firstArticle = Article::find(1);

        //Filtrar artículos por un usuario concreto
        $userArticles = Article::where('user_id', 1)->get();

        //Crear un nuevo artículo y guardarlo
        $newArticle = new Article();
        $newArticle->title = 'Nuevo artículo de prueba';
        $newArticle->content = 'Contenido de prueba creado con Eloquent.';
        $newArticle->user_id = 1;
        $newArticle->save(); //inserta el artículo nuevo en la tabla.

        //Contar artículos totales
        $total = Article::count();

        // Mostrar los resultados directamente en texto (sin vista), debido a que sólo queríamos probar que Eloquent funciona.
        return response()->json([
            'total_articles' => $total,
            'all_articles' => $allArticles,
            'first_article' => $firstArticle,
            'user_1_articles' => $userArticles,
            'new_article' => $newArticle,
        ]);
    }
}
