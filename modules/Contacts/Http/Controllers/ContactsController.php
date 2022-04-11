<?php

namespace Modules\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Contacts\Data\Repositories\ContactRepository;

class ContactsController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function handle(Request $request): JsonResponse
    {
        $repository = new ContactRepository();
        $contacts = $repository->contacts($request->get('type'));

        $perPage = $request->get('per_page', env('SIMPLE_PAGINATE_PER_PAGE'));

        return response()->json($contacts->simplePaginate($perPage));
    }
}
