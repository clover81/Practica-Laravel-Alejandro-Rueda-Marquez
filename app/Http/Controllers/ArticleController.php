<?php

namespace App\Http\Controllers;

use App\Models\Article; //le dice al controlador que va a usar la clase Article (modelo Eloquent)
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ArticleController extends Controller
{
    

    public function index() //index nuevo para el punto 10 pulido, si hay usuario logeado, se muestran sus artículos, si no, iniciar sesión.
    {

    if (auth()->check()) { //esto lo que hace es devolver true o false, check está en auth\SessionGuard
        // Solo artículos del usuario autenticado
        $articles = Article::where('user_id', auth()->id())->get(); // si es true, te da los artículos cuyo user_id sea el del usuario actual.
    } else {
        // Invitado: ve todos los artículos
       // $articles = collect();
       $articles = \App\Models\Article::all();
    }

    return view('articles.index', compact('articles'));
}
//         // Obtener todos los artículos con Eloquent, aquí le indicamos que use el model Article. Y como Article extiende de Model, que que debe ir a la tabla articles e internamente ejecuta el SELECT
//         $articles = Article::all(); //modelo asociado a la tabla articles e internamente hace un SELECT * FROM articles;
//         // lo que devuelve es una colección de objetos Article, no un array plano.
// //         Cada objeto tiene las columnas de la tabla:

// // $article->id
// // $article->title
// // $article->content
// // $article->user_id
// // $article->created_at
// // ...

//         // Pasarlos a la vista 'articles.index'
//         return view('articles.index', compact('articles')); //['articles' => $articles] , la vista recivirá una variable con todos los artículos obtenidos de la BD
//     }

// ESQUEMA
// articles (tabla) ⟷ Article (modelo) ⟷ ArticleController ⟷ vista Blade.

public function show($id)
{
    // Buscar el artículo por su ID con Eloquent, si no lo encuentra lanza un error 404 
    $article = \App\Models\Article::findOrFail($id); 

    // Pasar el artículo a la vista
    return view('articles.show', compact('article')); //compact pasa la variable $article a la vista. articles.show viene del web.php cuando pones name('articles.show')
}

    public function create()
    {
        // Muestra el formulario
        return view('articles.create');
    }

    public function store(Request $request) //request viene primero de la vista, después del formulario y coge el POST y lo manda a request.
    {
        //Validación
        $validated = $request->validate([
            'title'   => ['required', 'string', 'min:3', 'max:255'],
            'content' => ['required', 'string', 'min:5'],
            'date'    => ['required', 'date'], // formato flexible: 2025-11-10, etc.
        ], [
            'title.required'   => 'El título es obligatorio.',
            'title.min'        => 'El título debe tener al menos :min caracteres.',
            'content.required' => 'El contenido es obligatorio.',
            'date.required'    => 'La fecha es obligatoria.',
            'date.date'        => 'La fecha no tiene un formato válido.',
        ]);

        try {
            //Guardar con Eloquent
            // Usamos 'created_at' como fecha de artículo
            $article = new Article();
            $article->title   = $validated['title'];
            $article->content = $validated['content'];
            $article->user_id    = auth()->id(); // sustituimos id=1
            $article->created_at = Carbon::parse($validated['date']); //Carbon es una clase de PHP que gestiona fechas y horas.Viene del formulario input date y como llega string lo convierte en fecha válida para guardarlo en la BD.
            $article->save();

            //Redirigir con mensaje de éxito
            return redirect()
                ->route('articles.index') 
                ->with('success', 'Artículo creado correctamente.');
        } catch (\Throwable $e) {
            // Mensaje de error
            return back()
                ->withInput()
                ->with('error', 'No se pudo crear el artículo: ' . $e->getMessage());
        }
    }

   public function destroy($id)
{
    try {
        $article = Article::findOrFail($id);

        if ($article->user_id !== auth()->id()) {
            return redirect()
                ->route('articles.index')
                ->with('error', 'No puedes borrar artículos de otros usuarios.');
        }

        $article->delete();

        return redirect()
            ->route('articles.index')
            ->with('success', 'Artículo borrado con éxito.');
    } catch (\Throwable $e) {
        return redirect()
            ->route('articles.index')
            ->with('error', 'No se pudo borrar el artículo.');
    }
}


    public function edit($id)
{
    $article = Article::findOrFail($id);

    // Asegurarse de que el artículo es del usuario autenticado
    if ($article->user_id !== auth()->id()) {
        abort(403, 'No puedes editar artículos de otros usuarios.');
    }

    // Reutilizamos la misma vista de creación
    return view('articles.create', compact('article'));
}

public function update(Request $request, $id)
{
    $article = Article::findOrFail($id);

    if ($article->user_id !== auth()->id()) {
        abort(403, 'No puedes editar artículos de otros usuarios.');
    }

    $validated = $request->validate([
        'title'   => ['required', 'string', 'min:3', 'max:255'],
        'content' => ['required', 'string', 'min:5'],
        'date'    => ['required', 'date'],
    ]);

    $article->title      = $validated['title'];
    $article->content    = $validated['content'];
    $article->created_at = Carbon::parse($validated['date']);
    $article->save();

    return redirect()
        ->route('articles.index')
        ->with('success', 'Artículo actualizado correctamente.');
}

}




