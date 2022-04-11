<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Accounts\Data\Models\Account;
use Modules\Accounts\Http\Requests\EditContactsRequest;

class EditAccountController extends Controller
{
    /**
     * @param EditContactsRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function handle(EditContactsRequest $request, int $id): JsonResponse
    {
        $account = Account::findOrFail($id);
        $account->fill($request->all());
        $account->save();

        return response()->json($account);
    }
}
