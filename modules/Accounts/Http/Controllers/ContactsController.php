<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Accounts\Data\Repositories\AccountContactsRepository;
use Modules\Contacts\Data\Enums\ContactTypeEnum;

class ContactsController extends Controller
{
    /**
     * @param Request $request
     * @param int $idAccount
     * @return JsonResponse
     */
    public function handle(Request $request, int $idAccount): JsonResponse
    {
        $repository = new AccountContactsRepository();

        $type = $request->has('type') ? ContactTypeEnum::from((int) $request->get('type')) : null;
        $contacts = $repository->contacts($idAccount, $type);

        $perPage = $request->get('per_page', env('SIMPLE_PAGINATE_PER_PAGE'));

        return response()->json($contacts->simplePaginate($perPage));
    }
}
