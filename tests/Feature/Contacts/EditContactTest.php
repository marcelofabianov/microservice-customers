<?php

namespace Tests\Feature\Contacts;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Contacts\Data\Enums\ContactTypeEnum;
use Modules\Contacts\Data\Models\Contact;
use Tests\TestCase;

class EditContactTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     * @group contacts
     */
    public function edit_contact()
    {
        $contact = Contact::factory()->create();

        $type = ContactTypeEnum::from(rand(1,2));

        $data = [
            'account_id' => $contact->id,
            'description' => $this->faker->name,
            'contact' => $type->value == 1 ? $this->faker->phoneNumber() : $this->faker->email,
            'type' => $type->value,
        ];

        $actual = $this->putJson(env('API_URL').'/contacts/'.$contact->id, $data, $this->headersAuthorization);

        $expected = [
            'id' => $actual['id'], // actual
            'account_id' => $contact->id, // expected
            'description' => $data['description'], // expected
            'contact' => $data['contact'], // expected
            'type' => $data['type'], // expected
            'createdAt' => Carbon::parse($contact->created_at)->toIso8601String(), // actual
            'updatedAt' => $actual['updatedAt'], // actual
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }
}
