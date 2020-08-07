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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{route('homepage')}}">Cricket Fixture</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>



        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('homepage')}}">Home <span class="sr-only">(current)</span></a>
                </li>
             
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Cricket Teams
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{route('teams')}}">Teams</a>
                        <a class="dropdown-item" href="{{route('match')}}">Cricket Fixture</a>
                        <a class="dropdown-item" href="{{route('points')}}">Point</a>
                    </div>
                </li>
            </ul>
            
        </div>
        <ul class="nav navbar-nav navbar-right" style="clear: both;">
        <li><a href="{{route('adminlogin')}}"><span class="glyphicon glyphicon-log-in"></span>Admin Login</a></li>
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