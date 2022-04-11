<?php

namespace Modules\Accounts\Data\Enums;

enum AccountStatusEnum: int
{
    case trial = 2;
    case trialFinish = 3;
    case client = 1;
    case contractPending = 7;
    case negotiationFinish = 6;
    case customerCanceled = 5;
    case customerOverDuePay = 4;
    case inactive = 0;
}
