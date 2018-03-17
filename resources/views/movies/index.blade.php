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

    @if(Auth::check())
        <div class="panel-heading"><a  class="pull-right btn btn-primary btn-sm" href="/movie/create">
        <i class="fa fa-plus-square" aria-hidden="true"></i>  Add New Movie</a> </div>
    @endif

    </br>

    <div class="panel-body">
        @if(count($movies) > 0)
            <table class="table table-hover table-dark" border="1">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Year</th>
                        @if(Auth::check())
                            <th>Actions</th>
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
                                <div>{{ $movie->genre }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $movie->year }}</div>
                            </td>
                            @if(Auth::check())
                                <td>
                                    <li>
                                        <a href="/movie/edit/{{ $movie->id }}"><i class="fas fa-edit"></i> Edit</a></li>
                                    </li>
                                    <li>
                                        <a   
                                        href="/movie/{$movie->id}"
                                            onclick="
                                            var result = confirm('Are you sure you wish to delete this movie?');
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
                                        
                                    

                         
