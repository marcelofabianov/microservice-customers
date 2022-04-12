<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Accounts\Data\Enums\AccountStatusEnum;
use Modules\Accounts\Data\Repositories\AccountRepository;
use Modules\Accounts\Http\Resources\AccountCollection;

class AccountsController extends Controller
{
    /**
     * @param Request $request
     * @return AccountCollection
     */
    public function handle(Request $request): AccountCollection
    {
        $repository = new AccountRepository();

        $accounts = $repository->accounts(
            $request->has('status') ? AccountStatusEnum::from($request->get('status')) : null
        );

        $perPage = $request->get('per_page', env('SIMPLE_PAGINATE_PER_PAGE'));

        return new AccountCollection($accounts->simplePaginate($perPage));
    }
}
