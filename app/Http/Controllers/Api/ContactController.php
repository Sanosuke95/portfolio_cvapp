<?php

namespace App\Http\Controllers\Api;

use App\Enum\ResponseCodeHttp;
use App\Http\Requests\StoreContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ContactController extends BaseController
{
    /**
     * List all contact
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $contacts = ContactResource::collection(Contact::all())->resolve();
        return $this->sendResponse($contacts, 'Contact list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        Log::info('Begin');
        try {

            $contact = new Contact($request->all());

            Log::info('Save all data');
            $contact->save();

            $result = new ContactResource($contact);
            Log::info('Data save');
            return $this->sendResponse($result, 'Contact created');
        } catch (Exception $e) {
            $msg = 'Error in insert: ' . $e->getMessage();
            Log::error($msg);
            return $this->sendError($msg, ResponseCodeHttp::ERROR_REGISTER);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $result = new ContactResource($contact);
        return $this->sendResponse($result, 'Element');
    }


    /**
     * Delete method.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $this->sendResponse([], 'Message deleted');
    }
}
