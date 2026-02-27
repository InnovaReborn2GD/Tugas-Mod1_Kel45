<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modul 1 Kelompok 45</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
        font-family: 'Nunito', sans-serif;
        }
        body.dark-mode {
            background-color: #121212;
            color: #eaeaea;
        }
        body.dark-mode .navbar,
        body.dark-mode .card,
        body.dark-mode .table,
        body.dark-mode .modal-content {
            background-color: #1e1e1e !important;
            color: #eaeaea;
        }
        body.dark-mode .navbar-brand,
        body.dark-mode .navbar-nav .nav-link,
        body.dark-mode .navbar-text {
            color: #eaeaea !important;
        }
        body.dark-mode .btn-outline-dark {
            color: #eaeaea;
            border-color: #eaeaea;
        }
        body.dark-mode .table > :not(caption) > * > * {
            color: #eaeaea;
        }
        body.dark-mode .btn-primary {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }
    </style>
    </head>
    <body class="antialiased">
        <nav class="navbar bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('admin.index') }}">Modul 1 SBD - Kelompok 45 HEBATTT</a>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.index') }}" class="btn btn-sm {{ request()->routeIs('admin.index') ? 'btn-primary' : 'btn-outline-primary' }}">Data Admin</a>
                    <a href="{{ route('admin.trash') }}" class="btn btn-sm {{ request()->routeIs('admin.trash') ? 'btn-danger' : 'btn-outline-danger' }}">Trash</a>
                    <button id="darkModeToggle" class="btn btn-outline-dark btn-sm" type="button">
                        Dark Mode
                    </button>
                </div>
            </div>
        </nav>
        <div class="container"> @yield('content')
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const btn = document.getElementById('darkModeToggle');
            const saved = localStorage.getItem('darkMode');
            if (saved === 'true') document.body.classList.add('dark-mode');

            btn.addEventListener('click', () => {
                document.body.classList.toggle('dark-mode');
                localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
            });
        </script>
    </body>
</html>