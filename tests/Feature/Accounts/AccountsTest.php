<?php

namespace Tests\Feature\Accounts;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Microservice\Accounts\Data\Models\Account;
use Tests\TestCase;

class AccountsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     * @group accounts
     */
    public function list_of_accounts()
    {
        $account =  Account::factory()->create();

        $actual = $this->get(env('API_URL').'/accounts', $this->headersAuthorization);

        $expected = [
            'data' => [
                [
                    'id' => $account->id,
                    'document' => $account->document,
                    'name' => $account->name,
                    'address' => $account->address,
                    'district' => $account->district,
                    'city' => $account->city,
                    'complement' => $account->complement,
                    'status' => $account->status->value,
                    'createdAt' => Carbon::parse($account->created_at)->toIso8601String(),
                    'updatedAt' => Carbon::parse($account->updated_at)->toIso8601String(),
                ]
            ],
            'links' => [
                'first' => route('api.accounts.index').'?page=1',
                'last' => null,
                'prev' => null,
                'next' => null,
            ],
            'meta' => [
                'current_page' => 1,
                'from' => 1,
                'path' => route('api.accounts.index'),
                'per_page' => env('SIMPLE_PAGINATE_PER_PAGE', 20),
                'to' => 1
            ]
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }

    /**
     * @test
     * @group accounts
     */
    public function list_of_accounts_that_contain_status_parameter()
    {
        $account =  Account::factory()->create(['status' => 2]);

        $actual = $this->get(env('API_URL').'/accounts?status=2', $this->headersAuthorization);

        $expected = [
            'data' => [
                [
                    'id' => $account->id,
                    'document' => $account->document,
                    'name' => $account->name,
                    'address' => $account->address,
                    'district' => $account->district,
                    'city' => $account->city,
                    'complement' => $account->complement,
                    'status' => $account->status->value,
                    'createdAt' => Carbon::parse($account->created_at)->toIso8601String(),
                    'updatedAt' => Carbon::parse($account->updated_at)->toIso8601String(),
                ]
            ],
            'links' => [
                'first' => route('api.accounts.index').'?page=1',
                'last' => null,
                'prev' => null,
                'next' => null,
            ],
            'meta' => [
                'current_page' => 1,
                'from' => 1,
                'path' => route('api.accounts.index'),
                'per_page' => env('SIMPLE_PAGINATE_PER_PAGE', 20),
                'to' => 1
            ]
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }

    /**
     * @test
     * @group accounts
     */
    public function list_of_accounts_that_contain_links_parameter()
    {
        $account =  Account::factory()->create();

        $actual = $this->get(env('API_URL').'/accounts?links=true', $this->headersAuthorization);

        $expected = [
            'data' => [
                [
                    'id' => $account->id,
                    'document' => $account->document,
                    'name' => $account->name,
                    'address' => $account->address,
                    'district' => $account->district,
                    'city' => $account->city,
                    'complement' => $account->complement,
                    'status' => $account->status->value,
                    'createdAt' => Carbon::parse($account->created_at)->toIso8601String(),
                    'updatedAt' => Carbon::parse($account->updated_at)->toIso8601String(),
                    'links' => [
                        'self' => route('api.accounts.find', $account->id)
                    ]
                ]
            ],
            'links' => [
                'first' => route('api.accounts.index').'?page=1',
                'last' => null,
                'prev' => null,
                'next' => null,
            ],
            'meta' => [
                'current_page' => 1,
                'from' => 1,
                'path' => route('api.accounts.index'),
                'per_page' => env('SIMPLE_PAGINATE_PER_PAGE', 20),
                'to' => 1
            ]
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }

    /**
     * @test
     * @group accounts
     */
    public function list_of_accounts_that_contain_relationship_parameter()
    {
        $account =  Account::factory()->create();

        $actual = $this->get(env('API_URL').'/accounts?relationships[]=contacts', $this->headersAuthorization);

        $expected = [
            'data' => [
                [
                    'id' => $account->id,
                    'document' => $account->document,
                    'name' => $account->name,
                    'address' => $account->address,
                    'district' => $account->district,
                    'city' => $account->city,
                    'complement' => $account->complement,
                    'status' => $account->status->value,
                    'createdAt' => Carbon::parse($account->created_at)->toIso8601String(),
                    'updatedAt' => Carbon::parse($account->updated_at)->toIso8601String(),
                    'relationships' => [
                        'contacts' => [
                            'links' => [
                                'related' => route('api.accounts.contacts', $account->id)
                            ]
                        ]
                    ]
                ]
            ],
            'links' => [
                'first' => route('api.accounts.index').'?page=1',
                'last' => null,
                'prev' => null,
                'next' => null,
            ],
            'meta' => [
                'current_page' => 1,
                'from' => 1,
                'path' => route('api.accounts.index'),
                'per_page' => env('SIMPLE_PAGINATE_PER_PAGE', 20),
                'to' => 1
            ]
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }
}
