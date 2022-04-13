<?php

namespace Tests\Feature\Contacts;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Contacts\Data\Models\Contact;
use Tests\Feature\OAuth;
use Tests\TestCase;

class FindContactTest extends TestCase
{
    use RefreshDatabase;
    use OAuth;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     */
    public function find_contact()
    {
        $contact = Contact::factory()->create();

        $actual = $this->get(env('API_URL').'/contacts/'.$contact->id, $this->getHeadersAuthorization());

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
