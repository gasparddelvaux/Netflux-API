<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function index(Request $request)
    {
        $currentPage = $request->get('currentPage', 1);
        $itemsPerPage = $request->get('itemsPerPage', 10);
        $searchQuery = $request->get('searchQuery', '');

        $directors = [];

        if($searchQuery) {
            $directors = Director::where('firstname', 'like', "%$searchQuery%")
                        ->orWhere('lastname', 'like', "%$searchQuery%")
                        ->paginate($itemsPerPage, ['*'], 'page', $currentPage);
            return response()->json($directors, 200);
        } else {
            $directors = Director::paginate($itemsPerPage, ['*'], 'page', $currentPage);
            return response()->json($directors, 200);
        }

        return response()->json($directors, 200);
    }

    public function list()
    {
        $directors = Director::all();
        return response()->json($directors, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
        ]);

        $existingDirector = Director::firstWhere([
            ['firstname', '=', $request->firstname],
            ['lastname', '=', $request->lastname]
        ]);

        if ($existingDirector) {
            return response()->json([
                'message' => 'Un réalisateur avec ce nom et prénom existe déjà...',
                'type' => 'error'
            ], 400);
        }

        $director = Director::create($validatedData);

        return response()->json([
            'message' => 'Film créé',
            'type' => 'success'
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
        ]);

        $director = Director::where('id', $id)->first();
        if (!$director) {
            return response()->json([
                'message' => 'Réalisateur non trouvé',
                'type' => 'error'
            ], 404);
        }

        $director->update($validatedData);

        return response()->json([
            'message' => 'Réalisateur modifié',
            'type' => 'success'
        ], 200);
    }

    public function destroy(string $id)
    {
        $director = Director::where('id', $id)->first();
        if (!$director) {
            return response()->json([
                'message' => 'Réalisateur non trouvé',
                'type' => 'error'
            ], 404);
        }

        $director->delete();

        return response()->json([
            'message' => 'Réalisateur supprimé',
            'type' => 'success'
        ], 200);
    }
}
