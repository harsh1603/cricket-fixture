<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('global.site_title') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    @yield('styles')
    <style>
    .navbar {
        border-radius: 0px;
    }
    </style>
</head>

<body class="">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="{{route('homepage')}}">Cricket Fixture</a>

        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{route('homepage')}}">Home</a>
            </li>


            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Cricket Teams
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('teams')}}">Teams</a>
                    <a class="dropdown-item" href="{{route('match')}}">Cricket Fixture</a>
                    <a class="dropdown-item" href="#">Point</a>
                </div>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">

            <li><a href="{{route('adminlogin')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </nav>


    <div class="container">

        @yield('content')
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


    @yield('scripts')
</body>

</html>