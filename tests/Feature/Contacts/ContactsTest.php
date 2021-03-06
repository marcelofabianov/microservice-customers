<?php

namespace Tests\Feature\Contacts;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Microservice\Contacts\Data\Models\Contact;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     * @group contacts
     */
    public function list_of_contacts()
    {
        $contact = Contact::factory()->create();

        $actual = $this->get(env('API_URL').'/contacts', $this->headersAuthorization);

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
                'first' => route('api.contacts.index').'?page=1',
                'last' => null,
                'prev' => null,
                'next' => null,
            ],
            'meta' => [
                'current_page' => 1,
                'from' => 1,
                'path' => route('api.contacts.index'),
                'per_page' => env('SIMPLE_PAGINATE_PER_PAGE', 20),
                'to' => 1
            ]
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }

    /**
     * @test
     * @group contacts
     */
    public function contact_list_informed_type_parameter()
    {
        $contact = Contact::factory()->create(['type'=>3]);

        $actual = $this->get(env('API_URL').'/contacts?type=3', $this->headersAuthorization);

        $expected = [
            'data' => [
                [
                    'id' => $contact->id,
                    'account_id' => $contact->account_id,
                    'description' => $contact->description,
                    'contact' => $contact->contact,
                    'type' => 3, // expected
                    'createdAt' => Carbon::parse($contact->created_at)->toIso8601String(),
                    'updatedAt' => Carbon::parse($contact->updated_at)->toIso8601String(),
                ]
            ],
            'links' => [
                'first' => route('api.contacts.index').'?page=1',
                'last' => null,
                'prev' => null,
                'next' => null,
            ],
            'meta' => [
                'current_page' => 1,
                'from' => 1,
                'path' => route('api.contacts.index'),
                'per_page' => env('SIMPLE_PAGINATE_PER_PAGE', 20),
                'to' => 1
            ]
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }

    /**
     * @test
     * @group contacts
     */
    public function contact_list_informed_links_parameter()
    {
        $contact = Contact::factory()->create();

        $actual = $this->get(env('API_URL').'/contacts?links=true', $this->headersAuthorization);

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
                'first' => route('api.contacts.index').'?page=1',
                'last' => null,
                'prev' => null,
                'next' => null,
            ],
            'meta' => [
                'current_page' => 1,
                'from' => 1,
                'path' => route('api.contacts.index'),
                'per_page' => env('SIMPLE_PAGINATE_PER_PAGE', 20),
                'to' => 1
            ]
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }

    /**
     * @test
     * @group contacts
     */
    public function contact_list_informed_relationships_parameter()
    {
        $contact = Contact::factory()->create();

        $actual = $this->get(env('API_URL').'/contacts?relationships[]=account', $this->headersAuthorization);

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
                    'relationships' => [
                        'account' => [
                            'links' => [
                                'related' => route('api.accounts.find', $contact->account_id)
                            ]
                        ]
                    ]
                ]
            ],
            'links' => [
                'first' => route('api.contacts.index').'?page=1',
                'last' => null,
                'prev' => null,
                'next' => null,
            ],
            'meta' => [
                'current_page' => 1,
                'from' => 1,
                'path' => route('api.contacts.index'),
                'per_page' => env('SIMPLE_PAGINATE_PER_PAGE', 20),
                'to' => 1
            ]
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }
}
