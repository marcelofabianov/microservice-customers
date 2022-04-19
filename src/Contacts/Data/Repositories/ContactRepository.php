<?php

namespace Microservice\Contacts\Data\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Microservice\Contacts\Data\Enums\ContactTypeEnum;
use Microservice\Contacts\Data\Models\Contact;

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
