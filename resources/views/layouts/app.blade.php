<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gion Hospital') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    <style>
        body.guest {
            font-family: "Lato", sans-serif;
            background-color: black;
        }

        body.auth {
            font-family: "Lato", sans-serif;
            background-color: white;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
          .sidenav {padding-top: 15px;}
          .sidenav a {font-size: 18px;}
        }

    </style>

</head>

@guest
    <body class="guest">
@else
    <body class="auth">
@endguest

    <div id="app">
        <nav class="navbar navbar-light navbar-static-top" style="background-color: black;">
            <div class="container">
 
            <div id="mySidenav" class="sidenav">
     
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                @guest
                    <li><a href="{{ route('movie.index') }}"><i class="fas fa-film"></i> Movies</a></li>
                @else
                    <li><a href="{{ route('movie.index') }}"><i class="fas fa-film"></i> Movies</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off" aria-hidden="true"></i>  Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endguest
            </div>

            <span style="font-size:30px;cursor:pointer;color:white" onclick="openNav()">
                @guest
                    &#9776; 
                @else
                    &#9776; {{ Auth::user()->name }}
                @endguest
            
            </span>
            
            <script>
                function openNav() {
                    document.getElementById("mySidenav").style.width = "250px";
                }

                function closeNav() {
                    document.getElementById("mySidenav").style.width = "0";
                }
            </script> 


            <!-- Right Side Of Navbar-->
            <ul class="nav navbar-nav navbar-right">

            <div class="search-container">
                <form action="/movie/search" method="POST" role="search">
                    {{ csrf_field() }}
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit">Submit</button>
                </form>
            </div>

                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i></i> Login</a></li>
                    <li><a href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a></li>
                
                @else
                    <li><a href="{{ route('movie.index') }}"><i class="fas fa-film"></i> Movies</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" 
                        data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i>  {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                              <i class="fa fa-power-off" aria-hidden="true"></i>  Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                          </ul>
                      </li>
                  @endguest
              </ul>  
            </div>
        </nav>

        <div class="container" >

            @include('partials.errors')
            @include('partials.success')

            <div class="row">
                @yield('content')
            
            </div>
         </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('jqueryScript')

</body>
</html>
