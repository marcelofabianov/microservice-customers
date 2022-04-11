<?php

namespace Modules\Contacts\Data\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Modules\Contacts\Data\Enums\ContactTypeEnum;

trait ContactTypeScope
{
    /**
     * @param Builder $query
     * @param ContactTypeEnum $type
     * @return Builder
     */
    public function scopeType(Builder $query, ContactTypeEnum $type): Builder
    {
        return $query->where('type', $type);
    }
}
