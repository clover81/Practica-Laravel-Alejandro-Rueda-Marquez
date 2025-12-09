<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HolaController extends Controller {
   public function index() { //devuelve texto plano
      return "Hola, mundo";
   }
   public function show($nombre) {
      return view('hola', ['nombre' => $nombre]); //devuelve la vista resources/views/hola.blade.php con la variable $nombre
}

public function articles() //creamos datos por ahora a mano y devolvemos la vista de resources/views/articles/page.blade.php y le pasa esas variables
{
    $id = 1;
    $username = 'Alejandro';
    $articles = [
        'Introducción a Laravel',
        'Blade: el motor de plantillas',
        'Eloquent ORM básico',
    ];

    return view('articles.page', compact('id', 'username', 'articles')); // la estructura de la vista es ruta a la vista, compact es una función nativa de PHP que crea una array asociativo, es como escribir lo siguiente: es decir, le estás enviando tres variables a la vista.
}


}

// return view('articles.page', [
//     'id' => $id,
//     'username' => $username,
//     'articles' => $articles,
// ]);
