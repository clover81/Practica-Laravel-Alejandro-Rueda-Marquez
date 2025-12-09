@extends('layouts.master')

@section('title', 'Artículos del autor') <!-- rellena <title> -->

@section('sidebar')
    @parent <!-- copia desde sidebar hasta show de la vista, lo que hace es añadir esto además de lo que tenga el layout master, si no se pone parent este sidebar lo sustituye totalmente-->
    <p>Sección personalizada del sidebar para la vista de artículos.</p>
@endsection

@section('content')
    <h1>Artículos del autor</h1>
    <p><strong>ID del autor:</strong> {{ $id }}</p>
    <p><strong>Nombre del autor:</strong> {{ $username }}</p>

    <h2>Lista de artículos:</h2>

    @if (count($articles) > 0) <!-- comprueba si el array tiene elementos -->
        <ul>
            @foreach ($articles as $title) <!-- recorre el array y muestra cada artículo-->
                <li>{{ $title }}</li>
            @endforeach
        </ul>
    @else
        <p><em>No existen artículos.</em></p>
    @endif
@endsection

