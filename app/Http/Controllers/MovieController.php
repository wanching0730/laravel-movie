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
            $this->validate($request, [
                'title' => 'min:2|max:20',
                'synopsis' => 'min:20|max:100'
                //'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
                // 'address' => 'required',
                // 'postcode' => 'required'
            ]);

            $genreName = Common::$genre[$request['genre']];
            $movieYear = Common::$years[$request['year']];

            $movie = new Movie;
            $movie->fill($request->all());
            $movie->fullGenre = $genreName;
            $movie->fullYear = $movieYear;
            $movie->save();

            $movieTitle = str_replace(' ', '', $request['title']);
            $file = $request->file('image');
            $filename = $movieTitle . '-' . $request['genre'] . '.jpg';
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
        $movieTitle = str_replace(' ', '', $movie->title);
        $file_name = $movieTitle . '-' . $movie->genre . '.jpg';
        $filename = Storage::url($file_name);
        if(!$movie) throw new ModelNotFoundException;

        return view('movies.show', ['movie' => $movie, 'filename' => $filename, 'movieTitle' => $movieTitle]);
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

        $genreName = Common::$genre[$request['genre']];
        $movieYear = Common::$years[$request['year']];

        $movie->fill($request->all());
        $movie->fullGenre = $genreName;
        $movie->fullYear = $movieYear;
        $movie->save();

        $movieTitle = str_replace(' ', '', $request['title']);
        $file = $request->file('image');
        $filename = $movieTitle . '-' . $request['genre'] . '.jpg';
        if($file) {
            if($filename)
                Storage::disk('public')->put($filename, file_get_contents($file));
        }

        return redirect()->route('movie.index')
        ->with('success', 'Movie was updated successfully');
    }

    public function destroy($id) 
    {
        $findMovie = Movie::find($id);
        // var_dump($findMovie);
        if($findMovie->delete()) {
            return redirect()->route('movie.index')
            ->with('success', 'Movie was deleted successfully');
        }

        return back()->withInput()->with('error', 'Movie could not be deleted');
    }

    public function getMovieBySort($sort) {

        if($sort == 'title') 
            $movies = Movie::orderBy('title', 'asc')->get();
        else if($sort == 'year')
            $movies = Movie::orderBy('fullYear', 'desc')->get();
        else 
            $movies = Movie::where('fullYear', $sort)->get();
        
        return view('movies.showYear', ['movies' => $movies]);

    }
}
