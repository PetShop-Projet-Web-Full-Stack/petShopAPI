<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    {{-- Bootsrap Icone--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- Bootsrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</head>
<body>
<header>
    @section('header')
        {{-- Navbarre --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('admin.index')}}">Pet Shop</a>
                @auth()
                    <ul class="navbar-nav">
                        <li class="nav-link">
                            <a href="{{route('admin.logout')}}" class="text-danger">
                                <i class="bi bi-box-arrow-left"></i> Déconnexion
                            </a>
                        </li>
                    </ul>
                @endauth
            </div>
        </nav>
    @show
</header>
<main class="mt-3">
    @section('content')
    @show
</main>
<footer>
    @section('footer')
    @show
</footer>
</body>
</html>

