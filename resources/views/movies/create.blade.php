<?php

use App\Common;

?>

@extends('layouts.app')

@section('content')

    <div class="row col-md-12 col-lg-12 col-sm-12">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <h1 align="center">Create New Movie</h1>

        <div class="row  col-md-12 col-lg-12 col-sm-12">

            {!! Form::model($movie, [
                'route' => ['movie.store'],
                'class' => 'form-horizontal'])
            !!}

            <div class="form-group row">
                {!! Form::label('movie-title', 'Title', [
                    'class' => 'control-label col-sm-3',
                ]) !!}

                <div class="col-sm-9">
                    {!! Form::text('title', null, [
                        'id' => 'movie-title',
                        'placeholder' => 'Eg: Batman',
                        'class' => 'form-control',
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
                <div class="control-label col-sm-3">
                    <label>Synopsis</label>
                </div>

                <div class="col-sm-9">
                    <textarea name="synopsis" placeholder="Eg: Very interesting and not boring at all" cols="40" rows="5"></textarea>
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('movie-image', 'Poster', [
                        'class' => 'control-label col-sm-3',
                    ]) !!}

                <div class="col-sm-9">
                    {!! Form::file('image', array('class' => 'image')) !!}
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

            {!! Form::close() !!}
        </div>
    </div>
        
@endsection





