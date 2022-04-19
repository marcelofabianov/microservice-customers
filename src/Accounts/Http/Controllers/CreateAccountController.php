<?php

namespace Microservice\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Microservice\Accounts\Business\DefaultStatusAccount;
use Microservice\Accounts\Data\Models\Account;
use Microservice\Accounts\Http\Requests\CreateAccountRequest;
use Microservice\Accounts\Http\Resources\AccountResource;

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
