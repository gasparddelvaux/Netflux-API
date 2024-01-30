<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all();
        return response()->json($movies, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::find($id);
        if(!$movie) {
            return response()->json([
                'message' => 'Movie not found',
                'code' => 'movie_not_found'
            ], 404);
        }
        return response()->json($movie, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:191',
            'year' => 'required|integer',
            'director' => 'required|string|max:191',
            'synopsis' => 'required|string',
            'cover' => 'required|string|max:191',
        ]);

        $movie = Movie::create($validatedData);
        return response()->json([
            'message' => 'Film créé',
            'type' => 'success'
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:191',
            'year' => 'required|integer',
            'director' => 'required|string|max:191',
            'synopsis' => 'required|string',
            'cover' => 'required|string|max:191',
        ]);

        $movie = Movie::find($id);

        if(!$movie) {
            return response()->json([
                'message' => 'Film non trouvé',
                'type' => 'error'
            ], 404);
        }

        $movie->update($validatedData);

        return response()->json([
            'message' => 'Film mis à jour',
            'type' => 'success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::find($id);

        if(!$movie) {
            return response()->json([
                'message' => 'Film non trouvé',
                'type' => 'error'
            ], 404);
        }

        $movie->delete();

        return response()->json([
            'message' => 'Film supprimé',
            'type' => 'success'
        ], 200);
    }
}
