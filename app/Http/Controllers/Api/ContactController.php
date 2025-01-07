<?php

namespace App\Http\Controllers\Api;

use App\Enum\ResponseCodeHttp;
use App\Http\Requests\StoreContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ContactController extends BaseController
{
    /**
     * List all contact
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $contacts = Contact::all();
        $result = ContactResource::collection($contacts)->resolve();
        return $this->jsonResponseSuccess('Contact list', $result);
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
            Log::info('Data create');
            return $this->jsonResponseSuccess('Contact created', $result);
        } catch (Exception $e) {
            $msg = 'Error in insert: ' . $e->getMessage();
            Log::error($msg);
            return $this->jsonResponseError($msg, ResponseCodeHttp::UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Show method
     * 
     * @param Contact $contact
     */
    public function show(Contact $contact)
    {
        Log::info('Get element id : ' . $contact->id);
        $result = new ContactResource($contact);
        return $this->jsonResponseSuccess('Element', $result);
    }


    /**
     * Delete method.
     */
    public function destroy(Contact $contact)
    {
        Log::info('Delete element id: ' . $contact->id);
        $contact->delete();
        return $this->jsonResponseSuccess('Element deleted');
    }
}
