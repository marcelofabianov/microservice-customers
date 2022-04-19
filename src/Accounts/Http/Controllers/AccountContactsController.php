<?php

namespace Microservice\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Microservice\Accounts\Data\Repositories\AccountContactsRepository;
use Microservice\Contacts\Data\Enums\ContactTypeEnum;
use Microservice\Contacts\Http\Resources\ContactCollection;

class AccountContactsController extends Controller
{
    /**
     * @param Request $request
     * @param int $idAccount
     * @return ContactCollection
     */
    public function handle(Request $request, int $idAccount): ContactCollection
    {
        $repository = new AccountContactsRepository();

        $type = $request->has('type') ? ContactTypeEnum::from((int) $request->get('type')) : null;
        $contacts = $repository->contacts($idAccount, $type);

        $perPage = $request->get('per_page', env('SIMPLE_PAGINATE_PER_PAGE'));

        return new ContactCollection($contacts->simplePaginate($perPage));
    }
}
