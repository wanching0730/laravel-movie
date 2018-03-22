<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>

    <style>

        *,
        *::before,
        *::after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        }

        .dark {
        background:#24252A;
        }

        .flex {
        min-height:50vh;
        display:flex;
        align-items:center;
        justify-content:center;
        }

        a.btn-dark {
        color:pink;
        text-decoration:none;
        -webkit-transition:0.3s all ease;
        transition:0.3s ease all;
        &:hover {
            color:#FFF;
        }
        &:focus {
            color:#FFF;
        }
        }

        .btn-dark {
        font-size:12px;
        letter-spacing:2px;
        text-transform:uppercase;
        display:inline-block;
        text-align:center;
        width:100px;
        font-weight:bold;
        padding:6px 0px;
        border:1px solid pink;
        border-radius:2px;
        position:relative;
        box-shadow: 0 2px 10px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.1);
        z-index:2;
        &:before {
            -webkit-transition:0.5s all ease;
            transition:0.5s all ease;
            position:absolute;
            top:0;
            left:50%;
            right:50%;
            bottom:0;
            opacity:0;
            content:'';
            background-color:$second;
            z-index:-1;
        }
        &:hover {
            &:before {
            -webkit-transition:0.5s all ease;
            transition:0.5s all ease;
            left:0;
            right:0;
            opacity:1;
            }
        }
        &:focus {
            &:before {
            -webkit-transition:0.5s all ease;
            transition:0.5s all ease;
            left:0;
            right:0;
            opacity:1;
            }
        }
        }

    </style>

</head>

<body>

    <?php
        use App\Common;
    ?>

    @extends('layouts.app')

    @section('content')

        <div class="container">
            <nav aria-label="breadcrumb" style="background-color: white;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Movies</li>
                </ol>
            </nav>
        </div>

        <div class="btn-group" style="width:100%">
            @for($i = 2009; $i <= 2018; $i++)
                @guest
                    <a href="/movie/sort/{{ $i }}" class="btn-dark">{{ $i }}</a>
                @else
                    <a href="/movie/sort/{{ $i }}" class="btn-dark" style="border: 1px solid red;">{{ $i }}</a>
                @endguest
            @endfor
        </div>

        <br></br>

        <a href="/movie/sort/{{'title'}}" class="btn-dark" style="border: 1px solid purple;">By Title</a>
        <a href="/movie/sort/{{'year'}}" class="btn-dark" style="border: 1px solid purple;">By Year</a>

        <br></br>

        @if(Auth::check())
            <div class="panel-heading"><a  class="pull-right btn btn-primary btn-sm" href="/movie/create">
            <i class="fa fa-plus-square" aria-hidden="true"></i>  Add New Movie</a> </div>
        @endif

        </br>

        <div class="panel-body">
            @if(count($movies) > 0)
                @guest
                    <table class="table table-hover table-dark" border="1" style="text-align: center; color: white; font-size: 16px;">
                @else 
                    <table class="table table-hover table-dark" border="1" style="text-align: center; color: grey; font-size: 16px;">
                @endguest
                    <thead>
                        <tr>
                            <th style="text-align: center;">No.</th>
                            <th style="text-align: center;">Title</th>
                            <th style="text-align: center;">Genre</th>
                            <th style="text-align: center;">Year</th>
                            @if(Auth::check())
                                <th colspan="2" style="text-align: center;">Actions</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($movies as $i => $movie)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $i+1 }}</div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        {!! link_to_route(
                                            'movie.show',
                                            $title = $movie->title,
                                            $parameters = [
                                                'id' => $movie->id,
                                            ]
                                        ) !!}
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $movie->fullGenre }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $movie->fullYear }}</div>
                                </td>
                                @if(Auth::check())
                                    <td>
                                        <li>
                                            <a href="/movie/edit/{{ $movie->id }}"><i class="fas fa-edit"></i> Edit</a></li>
                                        </li>
                                    </td>
                                    <td>
                                        <li>
                                            <a   
                                            href="#"
                                                onclick="
                                                var result = confirm('Are you sure you wish to delete this movie {{$movie->id}}?');
                                                    if( result ){
                                                            event.preventDefault();
                                                            document.getElementById('delete-form').submit();
                                                    }
                                                        "
                                                        ><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                                            <form id="delete-form" action="{{ route('movie.destroy',[$movie->id]) }}" 
                                                method="POST" style="display: none;">
                                                        <input type="hidden" name="_method" value="delete">  
                                                        {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="font-size: 18px;">
                    No records found
                </div>
            @endif
        </div>
    @endsection

</body>
</html>
                                        
                                    

                         
