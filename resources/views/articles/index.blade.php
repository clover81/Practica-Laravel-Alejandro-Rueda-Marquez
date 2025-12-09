@extends('layouts.master')

@section('title', 'Listado de Artículos')

@section('content')
    <h2>Listado de Artículos</h2>

    {{-- Mensajes flash --}}
    @if (session('success'))
        <div class="alert" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif


    {{-- Mensaje para invitados o usuarios autenticados --}}
    @guest
        <p style="margin-bottom: 15px;">
            Estás viendo todos los artículos publicados.
            <a href="{{ route('login') }}">Inicia sesión</a> para crear, editar o borrar los tuyos.
        </p>
    @endguest

    @auth
        <p style="margin-bottom: 15px;">
            Estás viendo tus propios artículos.
        </p>
    @endauth


    {{-- Enlace para crear artículo (solo usuarios autenticados) --}}
    @auth
        <p style="margin: .5rem 0 1rem;">
            <a href="{{ route('articles.create') }}">➕ Nuevo artículo</a>
        </p>
    @endauth


    {{-- Si no hay artículos --}}
    @if ($articles->isEmpty())
        @guest
            <p>No hay artículos que mostrar.</p>
        @else
            <p>No tienes artículos creados todavía.</p>
        @endguest

    @else
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Fecha</th>
                    @auth
                        <th>Acciones</th>
                    @endauth
                </tr>
            </thead>

            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        {{-- Título con enlace al detalle --}}
                        <td>
                            <a href="{{ route('articles.show', $article->id) }}"> <!-- aquí estamos generando el link según la ruta con nombre, articles.show sabe donde tieneque ir porque en web.php se puso name('articles.show') <a href="/articles/4">Ver artículo</a> -->
                                {{ $article->title }}
                            </a>
                        </td>

                        {{-- Fecha --}}
                        <td>{{ optional($article->created_at)->format('d/m/Y') }}</td>

                        {{-- Acciones solo para usuarios autenticados --}}
                        @auth
                            <td>

                                {{-- Botón Editar SOLO si el artículo es mío --}}
                                @if ($article->user_id === auth()->id())
                                    <a href="{{ route('articles.edit', $article->id) }}"
                                       style="background-color:#2980b9; color:white; padding:4px 8px; text-decoration:none; margin-right:5px;">
                                        Editar
                                    </a>

                                    {{-- Botón Eliminar --}}
                                    <form action="{{ route('articles.destroy', $article->id) }}"
                                          method="POST"
                                          style="display:inline"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este artículo?');">
                                        @csrf <!--se incluye de forma obligatoria en los formularios POST, PUT y DELETE para intertar un token secreto en el formulario, cambia cada sesión-->
                                        @method('DELETE')
                                        <button type="submit"
                                                style="background-color:#c0392b; color:white; border:none; padding:4px 8px; cursor:pointer;">
                                            Eliminar
                                        </button>
                                    </form>
                                @else
                                    <span style="color:gray;">(Sin permisos)</span>
                                @endif
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection




