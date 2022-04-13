<?php

namespace Tests\Feature\Accounts;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Contacts\Data\Models\Contact;
use Tests\Feature\OAuth;
use Tests\TestCase;

class AccountContactsTest extends TestCase
{
    use RefreshDatabase;
    use OAuth;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     */
    public function listing_account_contacts()
    {
        $contact = Contact::factory()->create();

        $uri = env('API_URL').'/accounts/'.$contact->account_id.'/contacts';
        $actual = $this->get($uri, $this->getHeadersAuthorization());

        $expected = [
            'data' => [
                [
                    'id' => $contact->id,
                    'account_id' => $contact->account_id,
                    'description' => $contact->description,
                    'contact' => $contact->contact,
                    'type' => $contact->type->value,
                    'createdAt' => Carbon::parse($contact->created_at)->toIso8601String(),
                    'updatedAt' => Carbon::parse($contact->updated_at)->toIso8601String(),
                ]
            ],
            'links' => [
                'first' => route('api.accounts.contacts', $contact->account_id).'?page=1',
                'last' => null,
                'prev' => null,
                'next' => null,
            ],
            'meta' => [
                'current_page' => 1,
                'from' => 1,
                'path' => route('api.accounts.contacts', $contact->account_id),
                'per_page' => env('SIMPLE_PAGINATE_PER_PAGE', 20),
                'to' => 1
            ]
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }

    /**
     * @test
     */
    public function account_contact_list_passing_link_parameter()
    {
        $contact = Contact::factory()->create();

        $uri = env('API_URL').'/accounts/'.$contact->account_id.'/contacts?links=true';
        $actual = $this->get($uri, $this->getHeadersAuthorization());

        $expected = [
            'data' => [
                [
                    'id' => $contact->id,
                    'account_id' => $contact->account_id,
                    'description' => $contact->description,
                    'contact' => $contact->contact,
                    'type' => $contact->type->value,
                    'createdAt' => Carbon::parse($contact->created_at)->toIso8601String(),
                    'updatedAt' => Carbon::parse($contact->updated_at)->toIso8601String(),
                    'links' => [
                        'self' => route('api.contacts.find', $contact->id)
                    ]
                ]
            ],
            'links' => [
                'first' => route('api.accounts.contacts', $contact->account_id).'?page=1',
                'last' => null,
                'prev' => null,
                'next' => null,
            ],
            'meta' => [
                'current_page' => 1,
                'from' => 1,
                'path' => route('api.accounts.contacts', $contact->account_id),
                'per_page' => env('SIMPLE_PAGINATE_PER_PAGE', 20),
                'to' => 1
            ]
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }
}
