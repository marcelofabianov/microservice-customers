<?php

namespace Modules\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Contacts\Data\Models\Contact;
use Modules\Contacts\Http\Requests\CreateContactRequest;
use Modules\Contacts\Http\Resources\ContactResource;

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
