<?php

namespace Modules\Accounts\Data\Enums;

enum AccountStatusEnum: int
{
    case TRIAL_PROGRESS = 2;
    case TRIAL_FINISH = 3;
    case CLIENT_ACTIVE = 1;
    case CONTRACT_PENDING = 7;
    case NEGOTIATION_FINISH = 6;
    case CUSTOMER_CANCELED = 5;
    case CUSTOMER_OVERDUE_PAY = 4;
    case INACTIVE = 0;
}
