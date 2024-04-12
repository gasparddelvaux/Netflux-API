<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'La validation a échouée',
                'type' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Vérifier si l'utilisateur existe
        $user = User::where('email', $request->email)->first();

        // Check mot de passe
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'E-mail ou mot de passe incorrect. Veuillez réessayer.',
                'type' => 'error'
            ], 401);
        }

        if($user->banned) {
            return response()->json([
                'message' => 'Votre compte a été banni. Veuillez contacter un administrateur.',
                'type' => 'error'
            ], 403);
        }

        // Supprimer ses anciens tokens si existants
        $user->tokens()->delete();

        // Créer le token
        $token = $user->createToken($user->email . '-apitoken', ['*'], now()->addHours(12))->plainTextToken;

        // Envoyer la réponse
        return response()->json([
            'message' => 'Connexion réussie',
            'type' => 'success',
            'user' => $user,
            'access_token' => $token,
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'La validation a échouée',
                'type' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        return response()->json([
            'message' => 'Compte créé avec succès. Vous pouvez maintenant vous connecter.',
            'type' => 'success'
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Déconnexion réussie',
            'type' => 'success'
        ]);
    }

    public function verifyToken(Request $request)
    {
        return response()->json([
            'message' => 'Token valide',
            'type' => 'success'
        ]);
    }
}
