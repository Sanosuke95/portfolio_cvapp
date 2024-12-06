<?php

namespace App\Http\Controllers\Api;

use App\Enum\ResponseCodeHttp;
use App\Enum\Step;
use App\Http\Requests\StoreResumeRequest;
use App\Http\Requests\UpdateResumeRequest;
use App\Http\Resources\ResumeResource;
use App\Models\Resume;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ResumeController extends BaseController
{

    /**
     * get current user
     * 
     * @var object
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
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $resumes = Resume::all()->where('user_id', '=', $this->user->id);
            $result = ResumeResource::collection($resumes)->resolve();
            return $this->sendResponse($result, 'List resume');
        } catch (Exception $e) {
            $msg = 'Error get all resumes : ' . $e->getMessage();
            Log::error($msg);
            return $this->sendError($msg, ResponseCodeHttp::ERROR_REGISTER);
        }
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @return JsonResponse
     */
    public function store(StoreResumeRequest $request): JsonResponse
    {

        Log::info("Begin insert");
        try {
            $resume = new Resume($request->all());
            $resume->user_id = $this->user->id;
            $resume->completed = false;

            if (is_null($resume->step))
                $resume->step = Step::STEP_SKILLS->value;

            Log::info('Insert data');
            $resume->save();

            $result = new ResumeResource($resume);
            return $this->sendResponse($result, 'Resume created');
        } catch (Exception $e) {
            $msg = 'Error in insert: ' . $e->getMessage();
            Log::error($msg);
            return $this->sendError($msg, ResponseCodeHttp::ERROR_REGISTER);
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param string $uuid
     * 
     * @return JsonResponse
     */
    public function show(string $uuid): JsonResponse
    {
        $resume = Resume::where('uuid', $uuid)->first();
        if (empty($resume))
            return $this->sendError('Element not found', ResponseCodeHttp::NOT_FOUND);
        $result = new ResumeResource($resume);
        return $this->sendResponse($result, 'Element recept');
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateResumeRequest $request
     * @param Resume $resume
     * 
     * @return JsonResponse
     */
    public function update(UpdateResumeRequest $request, Resume $resume): JsonResponse
    {
        try {
            $resume->update($request->all());
            $result = new ResumeResource($resume);
            return $this->sendResponse($result, 'Resume update');
        } catch (Exception $e) {
            $msg = 'Error in insert: ' . $e->getMessage();
            Log::error($msg);
            return $this->sendError($msg, ResponseCodeHttp::ERROR_REGISTER);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string $uuid
     * 
     * @return JsonResponse
     */
    public function destroy(string $uuid): JsonResponse
    {
        $resume = Resume::where('uuid', $uuid)->get();
        if (empty($resume))
            return $this->sendError('Element not found', ResponseCodeHttp::NOT_FOUND);
        $resume->delete();
        return $this->sendResponse([], 'Element delete');
    }
}
