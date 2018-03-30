<?php

use App\Common;

?>

@extends('layouts.app')

@section('content')

    <script>

        function validate() {
            var title = document.forms['myForm']['title'].value;
            var genre = document.forms['myForm']['genre'].value;
            var year = document.forms['myForm']['year'].value;
            var url = document.forms['myForm']['url'].value;
            var synopsis = document.forms['myForm']['synopsis'].value;
            var image = document.forms['myForm']['image'].value;
            var extension = image.substring(
                        image.lastIndexOf('.') + 1).toLowerCase();

            if(title=="" || genre=="" || year=="" || url=="" || synopsis=="" || image=="") {
                alert("Please complete all fields");
                return false;
            } else if(extension != "jpg") {
                alert("Invalid poster file! Poster only allows file type of .JPG");
                return false;
            } else if(title.length < 2 || title.length > 20) {
                alert("Invalid title! Title must be in the length of 2-20 characters");
                return false;
            } else if(synopsis.length < 20 || title.length > 100) {
                alert("Invalid synopsis! Synopsis must be in the length of 20-100 characters");
                return false;
            } else if(!url.includes("https") || !url.includes("www.") || !url.includes(".com")) {
                alert("Invalid trailer URL! Please follow this format of URL: https://www.youtube.com/watch?v=K4zm30yeHHE");
                return false;
            }
        }

    </script>

    <div class="row col-md-12 col-lg-12 col-sm-12">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <h1 align="center">Create New Movie</h1>

        <div class="row  col-md-12 col-lg-12 col-sm-12">

            <form name="myForm" method="post" action="{{ route('movie.store') }}" onSubmit="return validate()" enctype="multipart/form-data">
                {{ csrf_field() }}

            <div class="form-group row">
                {!! Form::label('movie-title', 'Title', [
                    'class' => 'control-label col-sm-3',
                ]) !!}

                <div class="col-sm-9">
                    {!! Form::text('title', null, [
                        'id' => 'movie-title',
                        'class' => 'form-control',
                        'placeholder' => 'Eg: Batman',
                        'maxlength' => 20,
                    ]) !!}
                </div>
            </div>

           <div class="form-group row">
                {!! Form::label('movie-genre', 'Genre', [
                    'class' => 'control-label col-sm-3',
                ]) !!}

                <div class="col-sm-9">
                    {!! Form::select('genre', Common::$genre, null, [
                        'class' => 'form-control',
                        'placeholder' => '- Select Genre -',
                    ]) !!}
                </div>
            </div>   

            <div class="form-group row">
                {!! Form::label('movie-year', 'Year Released', [
                    'class' => 'control-label col-sm-3',
                ]) !!}

                <div class="col-sm-9">
                    {!! Form::select('year', Common::$years, null, [
                        'class' => 'form-control',
                        'placeholder' => '- Select Year -',
                    ]) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('movie-url', 'Trailer URL', [
                    'class' => 'control-label col-sm-3',
                ]) !!}

                <div class="col-sm-9">
                    {!! Form::text('url', null, [
                        'id' => 'movie-url',
                        'class' => 'form-control',
                        'placeholder' => 'Eg: http://www.google.com',
                        'maxlength' => 50,
                    ]) !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="control-label col-sm-3">
                    <label>Synopsis</label>
                </div>

                <div class="col-sm-9">
                    <textarea name="synopsis" placeholder="Eg: Very interesting and not boring at all" cols="40" rows="5"></textarea>
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('movie-image', 'Poster (Only .jpg file)', [
                        'class' => 'control-label col-sm-3',
                    ]) !!}

                <div class="col-sm-9">
                    {!! Form::file('image') !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-offset-3 col-sm-6">
                    {!! Form::button('Save', [
                        'type' => 'submit',
                        'class' => 'btn btn-primary',
                    ]) !!}
                </div>
            </div>

        </form>
        </div>
    </div>
        
@endsection





