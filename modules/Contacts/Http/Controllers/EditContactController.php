<?php

namespace Modules\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Contacts\Data\Models\Contact;
use Modules\Contacts\Http\Requests\EditContactRequest;
use Modules\Contacts\Http\Resources\ContactResource;

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
