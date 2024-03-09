<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Renvoie la liste des films
     */
    public function index()
    {
        $movies = Movie::all()->where('user_id', auth()->user()->id);
        return response()->json($movies, 200);
    }

    /**
     * Renvoie un film spécifique
     */
    public function show(string $id)
    {
        $movie = Movie::where('user_id', auth()->user()->id)->where('id', $id)->first();
        if(!$movie) {
            return response()->json([
                'message' => 'Film non trouvé',
                'type' => 'error'
            ], 404);
        }
        return response()->json($movie, 200);
    }

    /**
     * Crée un nouveau film
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

        $movie = Movie::create($validatedData, ['user_id' => auth()->user()->id]);
        return response()->json([
            'message' => 'Film créé',
            'type' => 'success'
        ], 201);
    }

    /**
     * Met à jour un film spécifique
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

        $movie = Movie::where('user_id', auth()->user()->id)->where('id', $id)->first();

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
     * Supprime un film spécifique
     */
    public function destroy(string $id)
    {
        $movie = Movie::where('user_id', auth()->user()->id)->where('id', $id)->first();

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
