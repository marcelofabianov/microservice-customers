<?php

namespace Modules\Contacts\Data\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Modules\Contacts\Data\Enums\ContactTypeEnum;
use Modules\Contacts\Data\Models\Contact;

class ContactRepository
{
    /**
     * @param ContactTypeEnum|null $type
     * @return Builder
     */
    public function contacts(ContactTypeEnum $type = null): Builder
    {
        if ($type) {
            return Contact::type($type);
        }
        return Contact::query();
    }
}
