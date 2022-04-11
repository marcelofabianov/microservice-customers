<?php

namespace Modules\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Contacts\Data\Models\Contact;
use Modules\Contacts\Http\Requests\CreateContactRequest;

class CreateContactController extends Controller
{
    /**
     * @param CreateContactRequest $request
     * @return JsonResponse
     */
    public function handle(CreateContactRequest $request): JsonResponse
    {
        $contact = new Contact();
        $contact->fill($request->all());
        $contact->save();

        return response()->json($contact);
    }
}
