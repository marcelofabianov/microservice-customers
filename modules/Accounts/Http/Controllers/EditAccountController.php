<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Accounts\Data\Models\Account;
use Modules\Accounts\Http\Requests\EditAccountRequest;
use Modules\Accounts\Http\Resources\AccountResource;

class EditAccountController extends Controller
{
    /**
     * @param EditAccountRequest $request
     * @param int $id
     * @return AccountResource
     */
    public function handle(EditAccountRequest $request, int $id): AccountResource
    {
        $account = Account::findOrFail($id);
        $account->fill($request->all());
        $account->save();

        return new AccountResource($account);
    }
}
