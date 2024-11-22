<?php

namespace App\Http\Controllers\Api;

use App\Enum\ResponseCodeHttp;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
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
        return response()->json(['data' => $contacts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        Log::info('Debut insertion des données');
        try {
            $contact = new Contact();
            $contact->email = $request->email;
            $contact->uuid = $contact->newUUID();
            $contact->subject = $request->subject;
            $contact->content = $request->content;

            $contact->save();
            // $contact = Contact::create([
            //     'email' => $fields['email'],
            //     'subject' => $fields['subject'],
            //     'content' => $fields['content']
            // ]);

            // return $this->sendResponse($contact, 'Contact created');
            return response()->json(['data' => $contact]);
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
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
