<?php
    use App\Common;
?>

@extends('layouts.app')

@section('content')

    <div class="panel-body">
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
                        <img src='/movie/{{ $movie->id }}/image'/></td>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection