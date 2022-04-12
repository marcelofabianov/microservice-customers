<?php

namespace Tests\Feature\Accounts;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Accounts\Data\Models\Account;
use Tests\Feature\OAuth;
use Tests\TestCase;

class AccountsTest extends TestCase
{
    use RefreshDatabase;
    use OAuth;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     */
    public function list_of_accounts()
    {
        $account =  Account::factory()->create();

        $actual = $this->get(env('API_URL').'/accounts', $this->getHeadersAuthorization());

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

    public function list_of_accounts_that_contain_status_parameter()
    {
        $account =  Account::factory()->create();

        $actual = $this->get(env('API_URL').'/accounts?status=2', $this->getHeadersAuthorization());

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
}
