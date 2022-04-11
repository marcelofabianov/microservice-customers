<?php

namespace Modules\Accounts\Business;

use Modules\Accounts\Data\Enums\AccountStatusEnum;

class DefaultStatusAccount
{
    public static function get(): AccountStatusEnum
    {
        return AccountStatusEnum::TRIAL_PROGRESS;
    }
}
