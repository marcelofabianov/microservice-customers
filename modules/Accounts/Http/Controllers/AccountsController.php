<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Accounts\Data\Repositories\AccountRepository;

class AccountsController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function handle(Request $request): JsonResponse
    {
        $repository = new AccountRepository();
        $accounts = $repository->accounts($request->get('status'));

        $perPage = $request->get('per_page', env('SIMPLE_PAGINATE_PER_PAGE'));

        return response()->json($accounts->simplePaginate($perPage));
    }
}
