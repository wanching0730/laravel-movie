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
        var synopsis = document.forms['myForm']['synopsis'].value;

        if(title=="" || genre=="" || year=="" || synopsis=="") {
            alert("Please complete all fields");
            return false;
        }
    }

</script>

    <div class="panel-body">

        <form name="myForm" method="post" action="{{ route('movie.update', [$movie->id]) }}" onSubmit="return validate()">
                                    {{ csrf_field() }}

            <div class="form-group row">
                {!! Form::label('movie-title', 'Title', [
                    'class' => 'control-label col-sm-3',
                ]) !!}

                <div class="col-sm-9">
                    {!! Form::text('title', $movie->title, [
                        'id' => 'movie-title',
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
                    {!! Form::select('genre', Common::$genre, $movie->genre, [
                        'class' => 'form-control',
                        'placeholder' => '- Select Genre -',
                    ]) !!}
                </div>
            </div>   

            <div class="form-group row">
                {!! Form::label('movie-year', 'Years', [
                    'class' => 'control-label col-sm-3',
                ]) !!}

                <div class="col-sm-9">
                    {!! Form::select('year', Common::$years, $movie->year, [
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
                    <textarea name="synopsis" value="{{$movie->synopsis}}" cols="40" rows="5"></textarea>
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
                    {!! Form::button('Update', [
                        'type' => 'submit',
                        'class' => 'btn btn-primary',
                    ]) !!}
                </div>
            </div>

        </form>

    </div>
    
@endsection