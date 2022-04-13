<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Accounts\Data\Cache\AccountCache;
use Modules\Accounts\Http\Resources\AccountCollection;

class AccountsController extends Controller
{
    /**
     * @param Request $request
     * @return AccountCollection
     */
    public function handle(Request $request): AccountCollection
    {
        $cache = new AccountCache;
        $accounts = $cache->accounts($request);

        return new AccountCollection($accounts);
    }
}
