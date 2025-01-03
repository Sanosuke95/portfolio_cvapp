<?php

namespace App\Http\Controllers\Api;

use App\Enum\ResponseCodeHttp;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Http\Resources\SkillResource;
use App\Models\Resume;
use App\Models\Skill;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SkillController extends BaseController
{

    /**
     * get current user
     *
     * @var object $user
     */
    protected $user;


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
    public function index(Resume $resume): JsonResponse
    {
        try {
            $skills = SkillResource::collection($resume->skills)->resolve();
            return $this->jsonResponseSuccess('Skill list', $skills);
        } catch (Exception $e) {
            $msg = 'Error get all resumes : ' . $e->getMessage();
            Log::error($msg);
            return $this->jsonResponseError($msg, ResponseCodeHttp::ERROR_REGISTER);
        }
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreSkillRequest $request
     * @param Resume $resume
     * 
     * @return JsonResponse
     */
    public function store(Resume $resume, StoreSkillRequest $request): JsonResponse
    {
        Log::info("Begin insert");
        try {
            $skill = new Skill($request->all());
            $skill->user_id = $this->user->id;
            $skill->resume_id = $resume->id;
            if (is_null($skill->level))
                $skill->level = 1;

            Log::info('Insert data');
            $skill->save();

            $result = new SkillResource($skill);
            return $this->jsonResponseSuccess('Skill created', $result);
        } catch (Exception $e) {
            $msg = 'Error in insert: ' . $e->getMessage();
            Log::error($msg);
            return $this->jsonResponseError($msg, ResponseCodeHttp::ERROR_REGISTER);
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param Resume $resume
     * @param string $uuid
     */
    public function show(Resume $resume, string $uuid): JsonResponse
    {
        $skill = $resume->skills()->where('uuid', $uuid)->first();
        if (empty($skill))
            return $this->jsonResponseError('Element not found', ResponseCodeHttp::NOT_FOUND);
        $result = new SkillResource($skill);
        return $this->jsonResponseSuccess('Skill selected', $result);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateSkillRequest $request
     * @param Resume $resume
     * @param string $uuid
     */
    public function update(UpdateSkillRequest $request, Resume $resume, string $uuid): JsonResponse
    {
        try {
            $skill = $resume->skills()->where('uuid', $uuid)->first();
            $skill->update($request->all());
            $result = new SkillResource($skill);
            return $this->jsonResponseSuccess('Skill update', $result);
        } catch (Exception $e) {
            $msg = 'Error in insert: ' . $e->getMessage();
            Log::error($msg);
            return $this->jsonResponseError($msg, ResponseCodeHttp::ERROR_REGISTER);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resume $resume, string $uuid): JsonResponse
    {
        $skill = $resume->skills()->where('uuid', $uuid)->first();
        if (empty($skill))
            return $this->jsonResponseError('Element not found', ResponseCodeHttp::NOT_FOUND);

        $skill->delete();
        return $this->jsonResponseSuccess('Element delete');
    }
}
