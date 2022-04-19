<?php

namespace Microservice\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Microservice\Accounts\Data\Cache\AccountCache;
use Microservice\Accounts\Http\Resources\AccountCollection;

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
