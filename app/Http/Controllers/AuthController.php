<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @group Authentication
 *
 * Autenticación de usuarios.
 */
class AuthController extends Controller
{
    /**
     * Iniciar sesión de usuario.
     *
     * Se utiliza para autenticar a un usuario y generar un token de acceso.
     *
     * Credenciales por defecto.
     *
     * Correo: la-empresa@email.com.
     *
     * Contraseña: la-empresa
     *
     * @unauthenticated
     *
     * @bodyParam email string required Correo electrónico del usuario.
     * @bodyParam password string required Contraseña del usuario.
     *
     * @response 200 {
     *     "message": "User logged in successfully",
     *     "token": "i1|BNI1OPgBUlPdDewv3E7IdJNp6u8G8AtRZotfXT2"
     * }
     *
     * @response 401 {
     *     "message": "Unauthorized"
     * }
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'message' => 'User logged in successfully',
            'token' => $user->createToken('API TOKEN')->plainTextToken,
        ], 200);
    }

    /**
     * Cerrar sesión de usuario.
     *
     * Se utiliza para revocar el token de acceso y cerrar sesión de un usuario.
     *
     * @response 200 {
     *     "message": "User logged out successfully"
     * }
     *
     * @response 401 {
     *     "message": "Unauthenticated"
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User logged out successfully',
        ], 200);
    }
}
