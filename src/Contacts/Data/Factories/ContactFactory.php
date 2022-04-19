<?php

namespace Microservice\Contacts\Data\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Microservice\Accounts\Data\Models\Account;
use Microservice\Contacts\Data\Enums\ContactTypeEnum;
use Microservice\Contacts\Data\Models\Contact;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        $account = Account::factory()->create();

        $contact = ContactTypeEnum::from(rand(1,2));

        return [
            'account_id' => $account->id,
            'description' => $this->faker->name,
            'contact' => $contact->value == 1 ? $this->faker->phoneNumber() : $this->faker->email,
            'type' => $contact->value,
        ];
    }
}
