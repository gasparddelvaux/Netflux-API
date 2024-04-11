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
}
