@extends('layouts.master')

@section('title', $article->title)

@section('content')
    <h2>{{ $article->title }}</h2>

    <p><strong>Autor:</strong> {{ $article->user->name ?? 'Desconocido' }}</p>
    <p><strong>Fecha:</strong> {{ $article->created_at->format('d/m/Y') }}</p>

    <div style="margin-top: 20px;">
        <p>{{ $article->content }}</p>
    </div>

    <p style="margin-top: 20px;">
        <a href="{{ url('/articles') }}">← Volver al listado</a> <!--'/articles' ejecuta la Route::get('/articles', [ArticleController::class, 'index']); de articleControler-->
    </p>
@endsection
