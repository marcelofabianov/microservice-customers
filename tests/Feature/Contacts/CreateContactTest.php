<?php

namespace Tests\Feature\Contacts;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Accounts\Data\Models\Account;
use Modules\Contacts\Data\Enums\ContactTypeEnum;
use Tests\TestCase;

class CreateContactTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     */
    public function creating_new_contact()
    {
        $account = Account::factory()->create();

        $contact = ContactTypeEnum::from(rand(1,2));

        $data = [
            'account_id' => $account->id,
            'description' => $this->faker->name,
            'contact' => $contact->value == 1 ? $this->faker->phoneNumber() : $this->faker->email,
            'type' => $contact->value,
        ];

        $actual = $this->postJson(env('API_URL').'/contacts', $data, $this->headersAuthorization);

        $expected = [
            'id' => $actual['id'], // actual
            'account_id' => $account->id, // expected
            'description' => $data['description'], // expected
            'contact' => $data['contact'], // expected
            'type' => $data['type'], // expected
            'createdAt' => $actual['createdAt'], // actual
            'updatedAt' => $actual['updatedAt'], // actual
        ];

        $actual->assertCreated();

        $this->assertEquals($expected, $actual->json());
    }
}
