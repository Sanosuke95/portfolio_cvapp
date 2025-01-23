<?php

namespace App\Http\Controllers\Api;

use App\Enum\ResponseCodeHttp;
use App\Http\Requests\ExperienceRequest;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;
use App\Models\Resume;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ExperienceController extends BaseController
{
    /**
     * get current user
     *
     * @var object $user
     */
    protected object $user;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     * @param Resume $resume
     * 
     * @return JsonResponse
     */
    public function index(Resume $resume): JsonResponse
    {
        try {
            $experiences = ExperienceResource::collection($resume->experiences)->resolve();
            return $this->jsonResponseSuccess('Experience list', $experiences);
        } catch (Exception $e) {
            $msg = 'Error get all resumes : ' . $e->getMessage();
            Log::error($msg);
            return $this->jsonResponseError($msg, ResponseCodeHttp::UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExperienceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * 
     * @param Resume $resume
     * @param string $uuid
     */
    public function show(Resume $resume, string $uuid): JsonResponse
    {
        $experience = $resume->experiences()->where('uuid', $uuid)->first();
        if (empty($experience))
            return $this->jsonResponseError('Element not found', ResponseCodeHttp::NOT_FOUND);
        $result = new ExperienceResource($experience);
        return $this->jsonResponseSuccess('Experience selected', $result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExperienceRequest $request, Experience $experience)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        //
    }
}
