
<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Hatem Mohamed">
    <title>Converted In FullStack Developer Task</title>


    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{asset('assets/images/favicons/apple-touch-icon.png')}}" sizes="180x180">
    <link rel="icon" href="{{asset('assets/images/favicons/favicon-32x32.png')}}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{asset('assets/images/favicons/favicon-16x16.png')}}" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="{{asset('assets/images/favicons/safari-pinned-tab.svg')}}" color="#7952b3">
    <link rel="icon" href="{{asset('assets/images/favicons/favicon.ico')}}">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/cover.css')}}" rel="stylesheet">

    @yield('css')
</head>
<body class="d-flex h-100 text-center text-white1 bg-dark">

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
            <h3 class="float-md-start mb-0">ConvertedIn</h3>
            <nav class="nav nav-masthead justify-content-center float-md-end">
                <a class="nav-link @if(in_array(request()->route()->getName(), ['home', 'dashboard']))  active @endif" aria-current="page" href="{{route('home')}}">Home</a>
               @auth
                    @if(auth()->user()->isAdmin())
                        <a class="nav-link @if(request()->route()->getName() === 'admin.tasks.index')  active @endif" href="{{route('admin.tasks.index')}}">Tasks</a>
                        <a class="nav-link @if(request()->route()->getName() === 'admin.tasks.create') active @endif" href="{{route('admin.tasks.create')}}">Add New Tasks</a>
                        <a class="nav-link @if(request()->route()->getName() === 'admin.statistics') active @endif" href="{{route('admin.statistics')}}">Statistics</a>
                    @else
                        <a class="nav-link @if(request()->route()->getName() === 'me.tasks') active @endif" href="{{route('me.tasks')}}">My Tasks</a>
                    @endif
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
               @endauth

                @guest
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                    <a class="nav-link" href="{{route('register')}}">Register</a>
                @endguest

            </nav>
        </div>
    </header>

    <main class="px-3">
       @yield('content')
    </main>

    <footer class="mt-auto text-white-50">
        <p>By Hatem Mohamed.</p>
    </footer>
</div>


@yield('js')
</body>
</html>
