<?php

namespace Microservice\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Microservice\Contacts\Data\Models\Contact;

class DestroyContactController extends Controller
{
    /**
     * @param int $id
     * @return JsonResponse
     */
    public function handle(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json([]);
    }
}
