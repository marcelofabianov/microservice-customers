<?php

namespace Tests\Feature\Contacts;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Microservice\Contacts\Data\Models\Contact;
use Tests\TestCase;

class FindContactTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     * @group contacts
     */
    public function find_contact()
    {
        $contact = Contact::factory()->create();

        $actual = $this->get(env('API_URL').'/contacts/'.$contact->id, $this->headersAuthorization);

        $expected = [
            'id' => $contact->id,
            'account_id' => $contact->account_id,
            'description' => $contact->description,
            'contact' => $contact->contact,
            'type' => $contact->type->value,
            'createdAt' => Carbon::parse($contact->created_at)->toIso8601String(),
            'updatedAt' => Carbon::parse($contact->updated_at)->toIso8601String(),
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }
}
