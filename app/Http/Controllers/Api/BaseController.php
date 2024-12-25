<?php

/**
 * 
 * Class pour les fonctions reutilisable
 */

namespace App\Http\Controllers\Api;

use App\Enum\ResponseCodeHttp;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;


class BaseController extends Controller
{

    /**
     * Send success response
     * 
     * @param string $message
     * @param array|JsonResource $data
     * 
     * @return JsonResponse
     */
    public function jsonResponseSuccess(string $message, array|JsonResource $data = []): JsonResponse
    {
        $response = ['success' => true, 'message' => $message];
        if (!empty($data))
            $response['data'] = $data;
        return response()->json($response, ResponseCodeHttp::SUCCESS->value);
    }

    /**
     * Send error response
     * 
     * @param string $message
     * @param ResponseCodeHttp $code
     * 
     * @return JsonResponse
     */
    public function jsonResponseError(string $message, ResponseCodeHttp $code = ResponseCodeHttp::NOT_FOUND)
    {
        $response = [
            'success' => false,
            'message' => $message,
            'code' => $code->value
        ];
        return response()->json($response);
    }
}
