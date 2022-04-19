<?php

namespace Microservice\Accounts\Business;

use Microservice\Accounts\Data\Enums\AccountStatusEnum;

class DefaultStatusAccount
{
    public static function get(): AccountStatusEnum
    {
        return AccountStatusEnum::trial;
    }
}
