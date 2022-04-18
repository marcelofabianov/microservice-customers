<?php

namespace Modules\Accounts\Data\Cache;

use Illuminate\Support\Facades\Cache;
use Modules\Accounts\Data\Enums\AccountStatusEnum;
use Modules\Accounts\Data\Models\Account;
use Modules\Accounts\Data\Repositories\AccountRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class AccountCache
{
    /**
     * @var array
     */
    private array $keys = [];

    /**
     * @param Request $request
     * @return Paginator
     */
    public function accounts(Request $request): Paginator
    {
        if (!Cache::has('accounts')) {
            $repository = new AccountRepository();

            $accounts = $repository->accounts(
                $request->has('status') ? AccountStatusEnum::from($request->get('status')) : null
            );

            $perPage = $request->get('per_page', env('SIMPLE_PAGINATE_PER_PAGE'));

            Cache::forever('accounts', $accounts->simplePaginate($perPage));
        }

        return Cache::get('accounts');
    }

    /**
     * @param int $id
     * @return Account
     */
    public function account(int $id): Account
    {
        if (!Cache::has('account')) {
            $account = Account::findOrFail($id);
            Cache::forever('account', $account);
        }

        return Cache::get('account');
    }

    /**
     * @param Account $account
     * @param string $action
     */
    public function recycleCache(Account $account, string $action)
    {
//        $cacheAccounts = Cache::get('accounts');
//        $cacheAccount = Cache::get('account');
//
//        if (in_array($action ['updated', 'restored', 'created'])) {
//            dd('aki');
//        }
//        if (in_array($action ['deleted', 'forceDeleted'])) {
//        dd('aki');
//        }
//        if ($account === $cacheAccount) {
//            dd('aki');
//        }
    }
}
