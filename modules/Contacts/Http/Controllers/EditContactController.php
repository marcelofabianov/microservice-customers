<?php

namespace Modules\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Contacts\Data\Models\Contact;
use Modules\Contacts\Http\Requests\EditContactRequest;

class EditContactController extends Controller
{
    /**
     * @param EditContactRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function handle(EditContactRequest $request, int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->fill($request->all());
        $contact->save();

        return response()->json($contact);
    }
}
