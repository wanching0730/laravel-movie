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

        .stylish-input-group .input-group-addon{
            background: white !important; 
        }
        .stylish-input-group .form-control{
            border-right:0; 
            box-shadow:0 0 0; 
            border-color:#ccc;
        }
        .stylish-input-group button{
            border:0;
            background:transparent;
        }

        #block1, #block2 {
            display: inline;
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

        <div class="btn-group" style="width:100%; text-align: center;">
            @for($i = 2009; $i <= 2018; $i++)
                @guest
                    <a href="/movie/sort/{{ $i }}" class="btn-dark">{{ $i }}</a>
                @else
                    <a href="/movie/sort/{{ $i }}" class="btn-dark" style="border: 1px solid red;">{{ $i }}</a>
                @endguest
            @endfor
        </div>

        <br></br>

        <div style="text-align: center;">
            <a href="/movie/sort/{{'title'}}" class="btn-dark" style="border: 1px solid purple;">By Title</a>
            <a href="/movie/sort/{{'year'}}" class="btn-dark" style="border: 1px solid purple;">By Year</a>
            <a href="/movie/sort/{{'fullGenre'}}" class="btn-dark" style="border: 1px solid purple;">By Genre</a>
            <br></br>
        </div>
        
        <form action="/movie/search" method="POST" role="search">
            {{ csrf_field() }}
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div id="imaginary_container"> 
                            <div class="input-group stylish-input-group">
                                <input type="text" class="form-control"  placeholder="Search by title/genre/year..." name="search">
                                <span class="input-group-addon">
                                    <button type="submit">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>  
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

         <!-- <div class="search-container">
         <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <form action="/movie/search" method="POST" role="search">
                {{ csrf_field() }}
                <input type="text" placeholder="Search.." name="search" style="border: 1px solid pink;">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
            </div>
	</div>
        </div> -->

        @if(Auth::check())
            <div class="panel-heading"><a  class="pull-right btn btn-primary btn-sm" href="/movie/create">
            <i class="fa fa-plus-square" aria-hidden="true"></i>  Add New Movie</a> </div>
        @endif

        </br>

        <form action="{{ route('movie.deleteAll') }}" method="post">
            {{ csrf_field() }}

        <div class="panel-body">
            @if(count($movies) > 0)
                @guest
                    <table class="table table-hover table-dark" border="1" style="text-align: center; color: white; font-size: 16px;">
                @else 
                    <table class="table table-hover table-dark" border="1" style="text-align: center; color: grey; font-size: 16px;">
                @endguest
                    <thead style="text-align: left;">
                        <tr>
                            @if(Auth::check())
                                <th width="50px"></th>
                            @endif                           
                            <th style="text-align:center;">No.</th>
                            <th style="text-align:center;">Poster</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Year</th>
                            @if(Auth::check())
                                <th style="text-align: center;">Action</th>
                            @else   
                                <th style="text-align: center;">Trailer</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody style="text-align: left;">
                        @foreach($movies as $i => $movie)
                            <tr>
                                @if(Auth::check())
                                    <td><input type="checkbox" name="delid[]"  value="{{ $movie->id }}"></td>
                                @endif
                                <td class="table-text">
                                    <div style="text-align:center;">{{ $i+1 }}</div>
                                </td>    
                                <td>            
                                    <img src="{{ url('storage/'.$movie->imageUrl) }}" alt="image" style="display:block; margin:0 auto;width:60px;height:100px;text-align:center;">
                                </td>                                                                    
                                <td class="table-text">
                                    <div id="block1">
                                        {!! link_to_route(
                                            'movie.show',
                                            $title = $movie->title,
                                            $parameters = [
                                                'id' => $movie->id,
                                            ]
                                        ) !!}
                                    </div>
                                    @if($movie->fullYear == 2018 || $movie->fullYear == 2017)
                                        <span id="block2" class="badge badge-secondary" style="margin-left: 6px;">New</span>
                                    @endif
                                </td>                         
                                <td class="table-text">
                                    <div>{{ $movie->fullGenre }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $movie->fullYear }}</div>
                                </td>
                                @if(Auth::check())
                                    <td style="text-align: center;">               
                                        <a href="/movie/edit/{{ $movie->id }}"><i class="fas fa-edit"></i> Edit</a></li>
                                    </td>
                                    <!-- <td>
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
                                    </td> -->
                                @else   
                                    <td style="text-align: center;">               
                                        <a href="/movie/trailer/{{ $movie->id }}"><i class="fas fa-play-circle"></i></a></li>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="font-size: 20px; text-align: center;">
                    No records found
                </div>
            @endif
        </div>
        @if(Auth::check())
            <div style="text-align: center;">
                <button type="submit" class="btn btn-danger">Delete Selected </button>
            </div>
        @endif
        </form>
    @endsection

</body>
</html>
                                        
                                    

                         
