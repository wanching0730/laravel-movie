<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>

    <style>
        .btn-group button {
            background-color: #4CAF50; /* Green background */
            border: 1px solid green; /* Green border */
            color: white; /* White text */
            padding: 10px 24px; /* Some padding */
            cursor: pointer; /* Pointer/hand icon */
            float: left; /* Float the buttons side by side */
        }

        /* Clear floats (clearfix hack) */
        .btn-group:after {
            content: "";
            clear: both;
            display: table;
        }

        .btn-group button:not(:last-child) {
            border-right: none; /* Prevent double borders */
        }

        /* Add a background color on hover */
        .btn-group button:hover {
            background-color: #3e8e41;
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
                <a href="/movie/sort/{{ $i }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">{{ $i }}</a>
            @endfor
        </div>

        <a href="/movie/sort/{{'title'}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">By Title</a>
        <a href="/movie/sort/{{'year'}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">By Year</a>


        @if(Auth::check())
            <div class="panel-heading"><a  class="pull-right btn btn-primary btn-sm" href="/movie/create">
            <i class="fa fa-plus-square" aria-hidden="true"></i>  Add New Movie</a> </div>
        @endif

        </br>

        <div class="panel-body">
            @if(count($movies) > 0)
                <table class="table table-hover table-dark" border="1" style="text-align: center;">
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
                <div>
                    No records found
                </div>
            @endif
        </div>
    @endsection

</body>
</html>
                                        
                                    

                         
