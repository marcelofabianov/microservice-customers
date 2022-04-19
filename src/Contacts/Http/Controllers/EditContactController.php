<?php

namespace Microservice\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Microservice\Contacts\Data\Models\Contact;
use Microservice\Contacts\Http\Requests\EditContactRequest;
use Microservice\Contacts\Http\Resources\ContactResource;

class EditContactController extends Controller
{
    /**
     * @param EditContactRequest $request
     * @param int $id
     * @return ContactResource
     */
    public function handle(EditContactRequest $request, int $id): ContactResource
    {
        $contact = Contact::findOrFail($id);
        $contact->fill($request->all());
        $contact->save();

        return new ContactResource($contact);
    }
}
