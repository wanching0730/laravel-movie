<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Response;
use App\Common; 

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy('title', 'asc')->get();

        return view('movies.index', ['movies' => $movies]);
    }

    public function create()
    {
        $movie = new Movie();

        return view('movies.create', ['movie' => $movie]);
    }

    public function store(Request $request)
    {
        if(Auth::check()) {
            // $this->validate($request, [
            //     'title' => 'required',
            //     'name' => 'required',
            //     'address' => 'required',
            //     'postcode' => 'required'
            // ]);

            $genreName = Common::$genre[$request['genre']];
            $movieYear = Common::$years[$request['year']];

            $movie = new Movie;
            $movie->fill($request->all());
            $movie->genre = $genreName;
            $movie->year = $movieYear;
            $movie->save();

            $file = $request->file('image');
            $filename = $request['title'] . '-' . $genreName . '.jpg';
            if($file) {
                if($filename)
                    Storage::disk('public')->put($filename, file_get_contents($file));
            }

            return redirect()->route('movie.index')
                ->with('success', 'Movie was added successfully');
        } 

        return redirect()->route('movie.index')->with('error', 'Error in creating new movie');
    }

    public function show($id)
    {
        $movie = Movie::find($id);
        $file_name = $movie->title . '-' . $movie->genre . '.jpg';
        $filename = Storage::url($file_name);
        if(!$movie) throw new ModelNotFoundException;

        return view('movies.show', ['movie' => $movie, 'filename' => $filename]);
    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        if(!$movie)
            throw new ModelNotFoundException;

        return view('movies.edit', ['movie' => $movie]);
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        if(!$movie)
            throw new ModelNotFoundException;

        $movie->fill($request->all());
        $movie->save();

        return redirect()->route('movie.index')
        ->with('success', 'Movie was updated successfully');
    }

    public function destroy($movieId) 
    {
        $findMovie = Movie::find($movieId);
        if($findMovie->delete()) {
            var_dump($movieId);
            // return redirect()->route('movie.index')
            // ->with('success', 'Movie was deleted successfully');
        }
    }
}
