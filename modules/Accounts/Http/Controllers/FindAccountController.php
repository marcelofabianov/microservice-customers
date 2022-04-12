<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Accounts\Data\Models\Account;
use Modules\Accounts\Http\Resources\AccountResource;

class FindAccountController extends Controller
{
    /**
     * @param int $id
     * @return AccountResource
     */
    public function handle(int $id): AccountResource
    {
        return new AccountResource(Account::findOrFail($id));
    }
}
