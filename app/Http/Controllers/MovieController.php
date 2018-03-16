<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

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

            $movie = new Movie;
            $movie->fill($request->all());
            $movie->save();

            return redirect()->route('movie.index')
                ->with('success', 'Movie was added successfully');
        } 

        return redirect()->route('movie.index')->with('error', 'Error in creating new movie');
    }

    public function show($id)
    {
        $movie = Movie::find($id);
        if(!$movie) throw new ModelNotFoundException;

        return view('movies.show', ['movie' => $movie]);
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

        return redirect()->route('movie.index');
    }

    public function destroy($movieId) 
    {
        $findMovie = Movie::find($movieId);
        if($findMovie->delete()) {
            return redirect()->route('movie.index')
            ->with('success', 'Movie was deleted successfully');
        }
    }
}
