<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Renvoie la liste des films avec pagination et recherche
     */
    public function index(Request $request)
    {
        $currentPage = $request->get('currentPage', 1);
        $itemsPerPage = $request->get('itemsPerPage', 10);
        $searchQuery = $request->get('searchQuery', '');

        $movies = [];

        if($searchQuery) {
            $movies = Movie::where('user_id', auth()->user()->id)
                        ->with('director')
                        ->where('name', 'like', "%$searchQuery%")
                        ->orWhere('director', 'like', "%$searchQuery%")
                        ->orWhere('year', 'like', "%$searchQuery%")
                        ->orWhere('synopsis', 'like', "%$searchQuery%")
                        ->paginate($itemsPerPage, ['*'], 'page', $currentPage);
            return response()->json($movies, 200);
        } else {
            $movies = Movie::where('user_id', auth()->user()->id)
                        ->with('director')
                        ->paginate($itemsPerPage, ['*'], 'page', $currentPage);
            return response()->json($movies, 200);
        }

        return response()->json($movies, 200);
    }

        /**
     * Renvoie la liste des films pour les admins avec pagination et recherche
     */
    public function indexAdmin(Request $request)
    {
        $currentPage = $request->get('currentPage', 1);
        $itemsPerPage = $request->get('itemsPerPage', 10);
        $searchQuery = $request->get('searchQuery', '');
        $userId = $request->get('userId', null);

        $movies = Movie::when($userId, function ($query, $userId) {
            return $query->where('user_id', $userId);
        })
        ->with('director', 'user')
        ->when($searchQuery, function ($query, $searchQuery) {
            return $query->where('name', 'like', "%$searchQuery%")
                         ->orWhere('director', 'like', "%$searchQuery%")
                         ->orWhere('year', 'like', "%$searchQuery%")
                         ->orWhere('synopsis', 'like', "%$searchQuery%");
        })
        ->paginate($itemsPerPage, ['*'], 'page', $currentPage);

        return response()->json($movies, 200);
    }

    /**
     * Renvoie un film spécifique
     */
    public function show(string $id)
    {
        $movie = Movie::where('user_id', auth()->user()->id)->where('id', $id)->first();
        if (!$movie) {
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
            'director_id' => 'required|integer',
            'synopsis' => 'required|string',
            'cover' => 'required|string|max:191',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        $movie = Movie::create($validatedData);

        return response()->json([
            'movie' => $movie,
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
            'director_id' => 'required|integer',
            'synopsis' => 'required|string',
            'cover' => 'required|string|max:191',
        ]);

        $movie = Movie::where('user_id', auth()->user()->id)->where('id', $id)->first();

        if (!$movie) {
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

        if (!$movie) {
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
