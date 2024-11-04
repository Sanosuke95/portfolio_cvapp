<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Fonction pour que l'utilisateur puisse se connecter
     * 
     * @return Response
     */
    public function login(LoginRequest $request): Response
    {

        // Récupération des champs du login
        $credentials = $request->all();

        if (Auth::attempt($credentials)) {
            /**
             *
             * @var  User
             */
            $user = Auth::user();
            $token = $user->createToken('authToken', ['*'])->plainTextToken;
            return response(
                [
                    'token' => $token
                ],
                200,
            );
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
