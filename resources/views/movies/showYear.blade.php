<?php
    use App\Common;
?>

@extends('layouts.app')

@section('content')

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
            <script>
                alert("No movie found")
            </script>

            <div style="font-size: 18px;">
                No records found
                <br></br>
            </div>
        @endif

        <a href="/movie" class="btn btn-primary btn-lg active" style="text-align: center;">Back</a>

    </div>
@endsection

                                    
                                

                        
