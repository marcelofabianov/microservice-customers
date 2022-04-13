<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Accounts\Data\Cache\AccountCache;
use Modules\Accounts\Http\Resources\AccountResource;

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
