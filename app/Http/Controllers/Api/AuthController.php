<?php

namespace App\Http\Controllers\Api;

use App\Enum\ResponseCodeHttp;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends BaseController
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

        Log::info('Check if credentials is good');
        if (Auth::attempt($credentials)) {
            $data = [];
            /**
             * @var  User
             */
            $user = Auth::user();
            $token = $user->createToken('authToken', ['*'], now()->addDay())->plainTextToken;
            $data['token'] = $token;

            // Recupération du acces token
            $personal_access_token = PersonalAccessToken::findToken($token);
            $data['expires_at'] = date_format($personal_access_token->expires_at, 'Y-m-d H:i:s');
            Log::info('User success login');
            return $this->sendResponse($data, 'Success login');
        } else {
            Log::error('Authenticated failed');
            return $this->sendError('Authenticated failed', ResponseCodeHttp::ERROR_LOGIN);
        }
    }


    /**
     * Inscription de l'utilisateur
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {

        Log::info('Begin user creation');
        try {

            $data = [];
            $user = new User($request->all());
            $user->save();
            Log::info("User create");

            $token = $user->createToken('authToken', ['*'], now()->addDay())->plainTextToken;
            $data['token'] = $token;
            Log::info($data);
            die();

            // Récupération du token
            $personal_access_token = PersonalAccessToken::findToken($token);
            $data['expires_at'] = date_format($personal_access_token->expires_at, 'Y-m-d H:i:s');
            Log::info('User logged in');

            return $this->sendResponse($data, 'User create.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->sendError($e->getMessage(), ResponseCodeHttp::ERROR_REGISTER);
        }
    }

    /**
     * Return user data
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function profile(Request $request)
    {
        $user = new UserResource($request->user());
        Log::info('User info');
        return $this->sendResponse($user, 'User info');
    }

    /**
     * Logout user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        Log::info('Log out');
        return $this->sendResponse([], 'Log out');
    }

    /**
     * Destroy user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        $request->user()->delete();
        return $this->sendResponse([], 'User detroy');
    }
}
