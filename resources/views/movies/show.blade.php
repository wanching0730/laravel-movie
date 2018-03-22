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
        </div>

        <div class="jumbotron">
            <h1 class="display-4" style="text-align: center; color: black;">{{ $movie->title }}</h1>
        </div>

        <div class="col-md-5 col-lg-5 col-sm-5 pull-left">
            @if(Storage::disk('public')->has($movieTitle . '-' . $movie->genre . '.jpg'))
                <img src="{{ $filename }}" alt="Norway" style="width:80%;height:60%;text-align:center;">
            @endif
        </div>

        <div class="col-md-7 col-lg-7 col-sm-7 pull-right">
            <div id="movie-details">
                <table class="table table-stripped" border="1" style="font-size: 16px; color: white">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Value</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Genre</td>
                            <td>{{ $movie->genre }}</td>
                        </tr>
                        <tr>
                            <td>Year</td>
                            <td>{{ $movie->year }}</td>
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

        <!-- <div class="panel-body">
            <table class="table table-stripped" border="1">
                <thead>
                    <tr>
                        <th>Attribute</th>
                        <th>Value</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Title</td>
                        <td>{{ $movie->title }}</td>
                    </tr>
                    <tr>
                        <td>Genre</td>
                        <td>{{ $movie->genre }}</td>
                    </tr>
                    <tr>
                        <td>Year</td>
                        <td>{{ $movie->year }}</td>
                    </tr>
                    <tr>
                        <td>Synopsis</td>
                        <td>{!!  nl2br($movie->synopsis) !!}</td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td>
                            @if(Storage::disk('public')->has($movieTitle . '-' . $movie->genre . '.jpg'))
                                <img src="{{ $filename }}" style="height:50px; width:50px;"> 
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> -->

    @endsection

</body>
</html>