<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Accounts\Business\DefaultStatusAccount;
use Modules\Accounts\Data\Models\Account;
use Modules\Accounts\Http\Requests\CreateAccountRequest;
use Modules\Accounts\Http\Resources\AccountResource;

class CreateAccountController extends Controller
{
    /**
     * @param CreateAccountRequest $request
     * @return AccountResource
     */
    public function handle(CreateAccountRequest $request): AccountResource
    {
        $account = new Account();
        $account->fill($request->all());
        $account->status = $request->get('status', DefaultStatusAccount::get());
        $account->save();

        return new AccountResource($account);
    }
}
