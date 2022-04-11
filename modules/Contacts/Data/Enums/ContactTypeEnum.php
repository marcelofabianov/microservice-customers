<?php

namespace Modules\Contacts\Data\Enums;

enum ContactTypeEnum: int
{
    case phone = 1;
    case email = 2;
    case app = 3;
    case other = 4;
}
