<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function info(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ], 200);
    }

    public function index(Request $request)
    {
        $currentPage = $request->get('currentPage', 1);
        $itemsPerPage = $request->get('itemsPerPage', 10);
        $searchQuery = $request->get('searchQuery', '');

        $users  = [];

        if ($searchQuery) {
            $users = User::where('name', 'like', "%$searchQuery%")
                ->orWhere('email', 'like', "%$searchQuery%")
                ->orWhere('role', 'like', "%$searchQuery%")
                ->with('movies')
                ->paginate($itemsPerPage, ['*'], 'page', $currentPage);
            return response()->json($users, 200);
        } else {
            $users = User::with('movies')->paginate($itemsPerPage, ['*'], 'page', $currentPage);
            return response()->json($users, 200);
        }

        return response()->json($users, 200);
    }

    // Fonction d'update qui permet le banissement d'un utilisateur
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'banned' => 'required|boolean',
            'role' => 'required|string'
        ]);

        if($validatedData['banned'] === true && $validatedData['role'] === 'admin') {
            return response()->json([
                'message' => 'Vous ne pouvez pas bannir un administrateur',
                'type' => 'error'
            ], 403);
        }

        $user = User::find($id);

        if($user['role'] != $validatedData['role']  && $request->user()->role !== 'superadmin') {
            return response()->json([
                'message' => 'Vous n\'avez pas les droits pour changer le rôle d\'un utilisateur',
                'type' => 'error'
            ], 403);
        }

        if (!$user) {
            return response()->json([
                'message' => 'Utilisateur non trouvé',
                'type' => 'error'
            ], 404);
        }

        $user->update($validatedData);

        return response()->json([
            'message' => 'Utilisateur mis à jour',
            'type' => 'success'
        ], 200);
    }
}
