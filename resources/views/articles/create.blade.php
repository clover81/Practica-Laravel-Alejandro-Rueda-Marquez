@extends('layouts.master') <!-- los @yield('title') y @yield('content') son “huecos” que las vistas hijas rellenan-->

@section('title', isset($article) ? 'Editar artículo' : 'Nuevo artículo')

@section('content')
    <h2>{{ isset($article) ? 'Editar artículo' : 'Nuevo artículo' }}</h2>

    {{-- Mensajes flash de error general --}}
    @if (session('error'))
        <div class="alert" role="alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- Errores de validación --}}
    @if ($errors->any())
        <div class="alert" role="alert">
            <strong>Hay errores en el formulario:</strong>
            <ul style="margin: .5rem 0 0 1rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- FORMULARIO: sirve tanto para crear como para editar --}} <!-- si existe article estamos editando, si no existe article estamos creando -->
    <form 
        action="{{ isset($article)   
            ? route('articles.update', $article->id) 
            : route('articles.store') 
        }}"
        method="POST"
        style="display:block; max-width:600px;"
    >
        @csrf

        {{-- Si es edición, usamos método PUT --}}
        @if(isset($article))
            @method('PUT')
        @endif

        {{-- Campo título --}}
        <div style="margin-bottom: .75rem;">
            <label for="title"><strong>Título</strong></label><br>
            <input 
                type="text" 
                id="title" 
                name="title" 
                value="{{ old('title', $article->title ?? '') }}" 
                style="width:100%; padding:.5rem;"
            >
            @error('title')
                <div style="color:#b10000; font-size:.9rem;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo contenido --}}
        <div style="margin-bottom: .75rem;">
            <label for="content"><strong>Contenido</strong></label><br>
            <textarea 
                id="content" 
                name="content" 
                rows="6" 
                style="width:100%; padding:.5rem;"
            >{{ old('content', $article->content ?? '') }}</textarea>
            @error('content')
                <div style="color:#b10000; font-size:.9rem;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo fecha --}}
        <div style="margin-bottom: .75rem;">
            <label for="date"><strong>Fecha</strong></label><br>
            <input 
                type="date" 
                id="date" 
                name="date" 
                value="{{ old('date', isset($article) ? $article->created_at->format('Y-m-d') : now()->format('Y-m-d')) }}" 
                style="padding:.5rem;">
            @error('date')
                <div style="color:#b10000; font-size:.9rem;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-top: 1rem;">
            <button type="submit" style="padding:.5rem 1rem;">
                {{ isset($article) ? 'Actualizar' : 'Guardar' }}
            </button>

            <a href="{{ route('articles.index') }}" style="margin-left: .5rem;">Cancelar</a>
        </div>
    </form>
@endsection
