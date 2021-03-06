<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    @can('manage-users')
                                    <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                        User management
                                    </a>
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        Create user
                                    </a>
                                    <hr class="col-xs-12">
                                    <a class="dropdown-item" href="{{ route('admin.teachers.index') }}">
                                        Teachers
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.students.index') }}">
                                        Students
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.classes.index') }}">
                                        Classes
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.subjects.index') }}">
                                        Subjects
                                    </a>
                                    @endcan
                                    @can('manage-marks')
                                    <a class="dropdown-item" href="{{ route('admin.marks.index') }}">
                                        Marks
                                    </a>
                                    @endcan
                                    @can('manage-events')
                                    <a class="dropdown-item" href="{{ route('admin.events.index') }}">
                                        Events
                                    </a>
                                    @endcan
                                    @can('show-marks')
                                    <a class="dropdown-item" href="{{ route('student.marks.index') }}">
                                        Marks
                                    </a>
                                    <a class="dropdown-item" href="{{ route('student.averages.index') }}">
                                        Averages
                                    </a>
                                    @endcan
                                    @can('show-events')
                                    <a class="dropdown-item" href="{{ route('student.events.index') }}">
                                        Events
                                    </a>
                                    @endcan
                                    <a class="dropdown-item" href="/elearning">
                                        E-Learning
                                    </a>
                                    <a class="dropdown-item" href="/opinion">
                                        Your opinion
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @include('partials.alerts')
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
