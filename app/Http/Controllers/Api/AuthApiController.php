<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiClient;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    /**
     * POST /api/auth/login
     * Autentica con client_id + client_secret (credenciales API independientes del login web).
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'client_id'     => 'required|string',
            'client_secret' => 'required|string',
            'token_name'    => 'sometimes|string|max:100',
        ]);

        $client = ApiClient::where('client_id', $request->client_id)
                           ->where('is_active', true)
                           ->first();

        if (!$client || !Hash::check($request->client_secret, $client->client_secret)) {
            return response()->json([
                'message' => 'Credenciales incorrectas.',
            ], 401);
        }

        // Revoca tokens anteriores del mismo nombre para evitar acumulación
        $tokenName = $request->input('token_name', 'default');
        $client->tokens()->where('name', $tokenName)->delete();

        $token = $client->createToken($tokenName)->plainTextToken;

        return response()->json([
            'token'      => $token,
            'token_type' => 'Bearer',
            'client'     => [
                'id'   => $client->id,
                'name' => $client->name,
            ],
        ]);
    }

    /**
     * POST /api/auth/login-user
     * Autentica con el mismo email + password del panel web y devuelve un token.
     */
    public function loginUser(Request $request): JsonResponse
    {
        $request->validate([
            'email'      => 'required|email',
            'password'   => 'required|string',
            'token_name' => 'sometimes|string|max:100',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales incorrectas.',
            ], 401);
        }

        $tokenName = $request->input('token_name', 'user-api');
        $user->tokens()->where('name', $tokenName)->delete();

        $token = $user->createToken($tokenName)->plainTextToken;

        return response()->json([
            'token'      => $token,
            'token_type' => 'Bearer',
            'user'       => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'roles' => $user->getRoleNames(),
            ],
        ]);
    }

    /**
     * POST /api/auth/logout
     * Revoca el token actual.
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Token revocado correctamente.']);
    }
}
