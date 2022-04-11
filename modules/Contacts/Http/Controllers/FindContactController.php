<?php

namespace Modules\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Contacts\Data\Models\Contact;

class FindContactController extends Controller
{
    /**
     * @param int $id
     * @return JsonResponse
     */
    public function handle(int $id): JsonResponse
    {
        return response()->json(Contact::findOrFail($id));
    }
}
