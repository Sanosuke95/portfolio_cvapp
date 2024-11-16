<?php

/**
 * 
 * Class pour les fonctions reutilisable
 */

namespace App\Http\Controllers;

use App\Enum\ResponseCodeHttp;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{

    /**
     * Send success response
     * 
     * @param string $message
     * @param array $data
     * 
     * @return JsonResponse
     */
    public function sendResponse(array $data, string $message): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'data' => $data,
                'message' => $message
            ],
            ResponseCodeHttp::SUCCESS->value
        );
    }

    /**
     * Send error response
     * 
     * @param string $message
     * @param ResponseCodeHttp $code
     * 
     * @return JsonResponse
     */
    public function sendError(string $message, ResponseCodeHttp $code = ResponseCodeHttp::NOT_FOUND)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'code' => $code->value
        ]);
    }
}
