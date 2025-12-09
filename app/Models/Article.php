<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; //importamos la clase base model de Eloquent

class Article extends Model// esta clase representa una tabla de BD,por convención Clase article(singular)--tabla articles(plural)
{
    use HasFactory; //permite usar factories para crear artículos falsos

    // Opcional, pero recomendable para esta práctica:
    protected $fillable = [ //qué campos se pueden asignar masivamente, le indicas los campos que va a rellenar.
        'title',
        'content',
        'user_id',
        'created_at'
    ];

    // Relación con el usuario (también opcional en este punto de la práctica)
    public function user()
    {
        return $this->belongsTo(User::class); //indica que cada artículo pertenece a un usuario, establece relaciones tablas
    }
}



// Eloquent convierte las tablas que ya existen en objetos PHP,  quiere decir que en vez de poner comandos SELECT etc se pone Article::finc(3)
// Es un ORM que mapea filas a objetos PHP y viceversa