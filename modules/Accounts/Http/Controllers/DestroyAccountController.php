<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Accounts\Data\Models\Account;

class DestroyAccountController extends Controller
{
    /**
     * @param int $id
     * @return JsonResponse
     */
    public function handle(int $id): JsonResponse
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return response()->json([]);
    }
}
