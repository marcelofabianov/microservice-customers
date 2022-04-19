<?php

namespace Microservice\Accounts\Data\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Microservice\Accounts\Data\Enums\AccountStatusEnum;

trait AccountStatusScope
{
    /**
     * @param Builder $query
     * @param AccountStatusEnum $status
     * @return Builder
     */
    public function scopeStatus(Builder $query, AccountStatusEnum $status): Builder
    {
        return $query->where('status', $status);
    }
}
