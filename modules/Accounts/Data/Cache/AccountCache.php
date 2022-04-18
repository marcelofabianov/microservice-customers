<?php

namespace Modules\Accounts\Data\Cache;

use App\Cache\BaseCache;
use Illuminate\Support\Facades\Cache;
use Modules\Accounts\Data\Enums\AccountStatusEnum;
use Modules\Accounts\Data\Models\Account;
use Modules\Accounts\Data\Repositories\AccountRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class AccountCache extends BaseCache
{
    protected function setDefaultKey()
    {
        $this->key = 'account';
        $this->keyCollection = 'accounts';
    }

    /**
     * @param Request $request
     * @return Paginator
     */
    public function accounts(Request $request): Paginator
    {
        if (!Cache::has($this->keyCollection)) {
            $repository = new AccountRepository();

            $accounts = $repository->accounts(
                $request->has('status') ? AccountStatusEnum::from($request->get('status')) : null
            );

            $perPage = $request->get('per_page', env('SIMPLE_PAGINATE_PER_PAGE'));

            Cache::forever($this->keyCollection, $accounts->simplePaginate($perPage));
        }

        return Cache::get($this->keyCollection);
    }

    /**
     * @param int $id
     * @return Account
     */
    public function account(int $id): Account
    {
        if (!Cache::has($this->key)) {
            $account = Account::findOrFail($id);
            Cache::forever($this->key, $account);
        }

        return Cache::get($this->key);
    }
}
