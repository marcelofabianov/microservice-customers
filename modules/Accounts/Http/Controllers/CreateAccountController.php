<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Accounts\Business\DefaultStatusAccount;
use Modules\Accounts\Data\Models\Account;
use Modules\Accounts\Http\Requests\CreateAccountRequest;

class CreateAccountController extends Controller
{
    /**
     * @param CreateAccountRequest $request
     * @return JsonResponse
     */
    public function handle(CreateAccountRequest $request): JsonResponse
    {
        $account = new Account();
        $account->fill($request->all());
        $account->status = $request->get('status', DefaultStatusAccount::get());
        $account->save();

        return response()->json($account);
    }
}
