<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            var_dump(now()->addDay());
            return response()->json(
                [
                    'message' => 'Success login',
                    'token' => $token
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'message' => 'Authenticated failed'
                ],
                401
            );
        }
    }


    /**
     * Inscription de l'utilisateur
     *
     * @return Response
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

            if (!$user)
                throw new Exception('Imposssible de créer un utilisateur', 401);

            $token = $user->createToken('authToken', ['*'], now()->addDay())->plainTextToken;
            return response()->json(
                [
                    'message' => 'Success login',
                    'token' => $token
                ],
                201,
            );
        } catch (Exception $e) {
            Log::error($e->getMessage(), 'error');
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
