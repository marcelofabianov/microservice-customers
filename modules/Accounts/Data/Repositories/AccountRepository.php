<?php

namespace Modules\Accounts\Data\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Modules\Accounts\Data\Enums\AccountStatusEnum;
use Modules\Accounts\Data\Models\Account;

class AccountRepository
{
    /**
     * @param AccountStatusEnum|null $status
     * @return Builder
     */
    public function accounts(AccountStatusEnum $status = null): Builder
    {
        if ($status) {
            return Account::status($status);
        }

        return Account::query();
    }
}
