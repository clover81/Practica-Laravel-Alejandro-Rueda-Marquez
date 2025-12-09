<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    {{-- Carga CSS/JS compilados por Vite (Bootstrap/Tailwind según Breeze) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: white;
            padding: 20px 25px;
            border-radius: 8px;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px 10px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .alert {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="text-align:right; margin-bottom: 10px;">
    @auth
        <span>Hola, {{ auth()->user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;"> <!--sabe donde está esa ruta porque en routes/web.php hemos puesto require __DIR__.'/auth.php';-->
            @csrf
            <button type="submit" style="margin-left: 10px;">Cerrar sesión</button>
        </form>
    @endauth

    @guest
        <a href="{{ route('login') }}">Iniciar sesión</a>
        |
        <a href="{{ route('register') }}">Registrarse</a>
    @endguest
    </div>

        @section('sidebar') 
            <p><strong>Menú principal</strong></p>
        @show <!-- cierra la sección del sidebar y la muestra inmediatamente -->
        <main>
            @yield('content') 
        </main>

        <footer>
            <p>Alejandro Rueda Márquez — Práctica Laravel</p>
        </footer>
    </div>
</body>
</html>
