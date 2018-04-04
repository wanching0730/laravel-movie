<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>

    <style>
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
                                    <td style="text-align:center;">                                      
                                        <a href="/movie/edit/{{ $movie->id }}"><i class="fas fa-edit"></i> Edit</a></li>                                       
                                    </td>                                    
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
                <script>
                    alert("No movie found")
                </script>

                <div style="font-size: 20px; text-align: center;">
                    No records found
                    <br></br>
                </div>
            @endif

            
                <div style="text-align: center;">
                    @if(Auth::check() && count($movies) > 0)
                        <button type="submit" class="btn btn-danger">Delete Selected </button>
                    @endif
                    <a href="/movie" class="btn btn-primary active">Back</a>
                </div>
        
            </form>

        </div>
    @endsection
    
</body>

</html>



                                    
                                

                        
