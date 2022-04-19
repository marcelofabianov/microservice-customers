<?php

namespace Microservice\Accounts\Data\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Microservice\Contacts\Data\Enums\ContactTypeEnum;
use Microservice\Contacts\Data\Models\Contact;

class AccountContactsRepository
{
    /**
     * @param int $idAccount
     * @param ContactTypeEnum|null $type
     * @return Builder
     */
    public function contacts(int $idAccount, ContactTypeEnum $type = null): Builder
    {
        $contacts = Contact::where('account_id', $idAccount);

        if ($type) {
            $contacts = $contacts->type($type);
        }

        return $contacts;
    }
}
