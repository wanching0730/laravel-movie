<?php
    use App\Common;
?>

@extends('layouts.app')

@section('content')

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

                                    
                                

                        
