<?php

namespace App\Http\Controllers\Api;

use App\Enum\ResponseCodeHttp;
use App\Http\Requests\FormationRequest;
use App\Http\Resources\FormationResource;
use App\Models\Formation;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class FormationController extends BaseController
{
    /**
     * get current user
     *
     * @var object $user
     */
    protected object $user;


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
            $formations = FormationResource::collection($resume->formations)->resolve();
            return $this->jsonResponseSuccess('Formation list', $formations);
        } catch (Exception $e) {
            $msg = 'Error get all resumes : ' . $e->getMessage();
            Log::error($msg);
            return $this->jsonResponseError($msg, ResponseCodeHttp::UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Resume $resume
     * @param FormationRequest $request
     * 
     * @return JsonResponse
     */
    public function store(Resume $resume, FormationRequest $request): JsonResponse
    {
        Log::info("Begin insert");
        try {
            $formation = new Formation($request->all());
            $formation->user_id = $this->user->id;
            $formation->resume_id = $resume->id;

            Log::info('Insert data');
            $formation->save();

            $result = new FormationResource($formation);
            return $this->jsonResponseSuccess('Formation created', $result);
        } catch (Exception $e) {
            $msg = 'Error in insert: ' . $e->getMessage();
            Log::error($msg);
            return $this->jsonResponseError($msg, ResponseCodeHttp::UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param Resume $resume
     * @param string $uuid
     * 
     * @return JsonResponse
     */
    public function show(Resume $resume, string $uuid): JsonResponse
    {
        $formation = $resume->formations()->where('uuid', $uuid)->first();
        if (empty($formation))
            return $this->jsonResponseError('Element not found', ResponseCodeHttp::NOT_FOUND);
        $result = new FormationResource($formation);
        return $this->jsonResponseSuccess('Formation selected', $result);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param FormationRequest $request
     * @param Resume $resume
     * @param string $uuid
     * 
     * @return JsonResponse
     */
    public function update(FormationRequest $request, Resume $resume, string $uuid): JsonResponse
    {
        try {
            $formation = $resume->formations()->where('uuid', $uuid)->first();
            $formation->update($request->all());
            $formation->save();
            $result = new FormationResource($formation);
            return $this->jsonResponseSuccess('Formation update', $result);
        } catch (Exception $e) {
            $msg = 'Error in insert: ' . $e->getMessage();
            Log::error($msg);
            return $this->jsonResponseError($msg, ResponseCodeHttp::UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Resume $resume
     * @param string $uuid
     * 
     * @return JsonResponse
     */
    public function destroy(Resume $resume, string $uuid): JsonResponse
    {
        $formation = $resume->formations()->where('uuid', $uuid)->first();
        if (empty($formation))
            return $this->jsonResponseError('Element not found', ResponseCodeHttp::NOT_FOUND);

        $formation->delete();
        return $this->jsonResponseSuccess('Element delete');
    }
}
