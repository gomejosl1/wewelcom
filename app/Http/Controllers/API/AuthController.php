<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Controlador para gestión de autenticación y API Keys
 */
class AuthController extends Controller
{
    /**
     * Registrar un nuevo usuario y generar API Key.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Error de validación'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_key' => Str::random(32),
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'api_key' => $user->api_key,
            ],
            'message' => 'Usuario registrado con éxito'
        ], Response::HTTP_CREATED);
    }

    /**
     * Iniciar sesión y obtener API Key.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Error de validación'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciales inválidas'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email', $request->email)->first();

        // Regenerar API Key si no existe
        if (!$user->api_key) {
            $user->api_key = Str::random(32);
            $user->save();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'api_key' => $user->api_key,
            ],
            'message' => 'Inicio de sesión exitoso'
        ]);
    }

    /**
     * Regenerar API Key para el usuario autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function regenerateApiKey(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no autenticado'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user->api_key = Str::random(32);
        $user->save();

        return response()->json([
            'success' => true,
            'data' => [
                'api_key' => $user->api_key,
            ],
            'message' => 'API Key regenerada con éxito'
        ]);
    }
}
