<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>

    <style>

        .movie-container {
            position: absolute;
            color: white;
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
                <li class="breadcrumb-item"><a href="/movie">Movies</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $movie->title }}</li>
            </ol>
        </nav>
       

        <div class="jumbotron">
            <h1 class="display-4" style="text-align: center; color: black; font-family: Lucida Sans Unicode, Lucida Grande, sans-serif;">{{ $movie->title }}</h1>
        </div>

        <div class="col-md-5 col-lg-5 col-sm-5 pull-left">
            @if(Storage::disk('public')->has($movieTitle . '-' . $movie->genre . '.jpg'))
                <img src="{{ $filename }}" alt="Norway" style="width:80%;height:60%;text-align:center;">
            @endif
        </div>

        <a  class="btn btn-info btn-sm" href="/movie/trailer/{{$movie->id}}">
            <span class="glyphicon glyphicon-expand"></span>Trailer
        </a>

        <div class="col-md-7 col-lg-7 col-sm-7 pull-right">
            <div id="movie-details">
                @guest
                    <table class="table table-stripped" border="1" style="font-size: 16px; color: white">
                @else   
                    <table class="table table-stripped" border="1" style="font-size: 16px; color: grey">
                @endguest

                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Value</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Genre</td>
                                <td>{{ $movie->fullGenre }}</td>
                            </tr>
                            <tr>
                                <td>Year</td>
                                <td>{{ $movie->fullYear }}</td>
                            </tr>
                            <tr>
                                <td>Synopsis</td>
                                <td>{!!  nl2br($movie->synopsis) !!}</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection

</body>
</html>