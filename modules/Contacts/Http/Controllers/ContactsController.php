<?php

namespace Modules\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Contacts\Data\Enums\ContactTypeEnum;
use Modules\Contacts\Data\Repositories\ContactRepository;
use Modules\Contacts\Http\Resources\ContactCollection;

class ContactsController extends Controller
{
    /**
     * @param Request $request
     * @return ContactCollection
     */
    public function handle(Request $request): ContactCollection
    {
        $repository = new ContactRepository();

        $contacts = $repository->contacts(
            $request->has('type') ? ContactTypeEnum::from($request->get('type')) : null
        );

        $perPage = $request->get('per_page', env('SIMPLE_PAGINATE_PER_PAGE'));

        return new ContactCollection($contacts->simplePaginate($perPage));
    }
}
