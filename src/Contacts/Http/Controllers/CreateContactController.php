<?php

namespace Microservice\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Microservice\Contacts\Data\Models\Contact;
use Microservice\Contacts\Http\Requests\CreateContactRequest;
use Microservice\Contacts\Http\Resources\ContactResource;

class CreateContactController extends Controller
{
    /**
     * @param CreateContactRequest $request
     * @return ContactResource
     */
    public function handle(CreateContactRequest $request): ContactResource
    {
        $contact = new Contact();
        $contact->fill($request->all());
        $contact->save();

        return new ContactResource($contact);
    }
}
