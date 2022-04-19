<?php

namespace Microservice\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Microservice\Accounts\Data\Cache\AccountCache;
use Microservice\Accounts\Http\Resources\AccountResource;

class FindAccountController extends Controller
{
    /**
     * @param int $id
     * @return AccountResource
     */
    public function handle(int $id): AccountResource
    {
        $cache = new AccountCache();
        $account = $cache->account($id);

        return new AccountResource($account);
    }
}
