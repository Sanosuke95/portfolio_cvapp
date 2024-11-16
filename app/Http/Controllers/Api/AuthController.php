<?php

namespace App\Http\Controllers\Api;

use App\Enum\ResponseCodeHttp;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{

    /**
     * Fonction pour que l'utilisateur puisse se connecter
     * 
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {

        // Récupération des champs du login
        $credentials = $request->all();

        if (Auth::attempt($credentials)) {
            /**
             * @var  User
             */
            $user = Auth::user();
            $token = $user->createToken('authToken', ['*'], now()->addDay())->plainTextToken;

            // Recupération du acces token
            $personal_access_token = PersonalAccessToken::findToken($token);
            Log::info($personal_access_token->expires_at);
            return response()->json(
                [
                    'message' => 'Success login',
                    'token' => $token,
                    'expires_at' => $personal_access_token->expires_at
                ],
                ResponseCodeHttp::SUCCES_LOGIN,
            );
        } else {
            return response()->json(
                [
                    'message' => 'Authenticated failed'
                ],
                ResponseCodeHttp::ERROR_REGISTER
            );
        }
    }


    /**
     * Inscription de l'utilisateur
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {

        try {

            $fields = $request->all();

            $user = User::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'password' => $fields['password'],
            ]);

            $token = $user->createToken('authToken', ['*'], now()->addDay())->plainTextToken;
            return response()->json(
                [
                    'message' => 'User create',
                    'token' => $token
                ],
                ResponseCodeHttp::SUCCES_LOGIN,
            );
        } catch (Exception $e) {
            Log::error('Erreur dans la construction');
            Log::error($e->getTraceAsString());
            return response()->json(['message' => $e->getMessage()], ResponseCodeHttp::ERROR_REGISTER);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
