<?php

namespace Tests\Feature\Accounts;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Accounts\Data\Models\Account;
use Tests\Feature\OAuth;
use Tests\TestCase;

class FindAccountTest extends TestCase
{
    use RefreshDatabase;
    use OAuth;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     */
    public function find_account()
    {
        $account = Account::factory()->create();

        $actual = $this->get(env('API_URL').'/accounts/'.$account->id, $this->getHeadersAuthorization());

        $expected = [
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
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }

    /**
     * @test
     */
    public function find_account_passing_contact_relationship_parameter()
    {
        $account = Account::factory()->create();

        $actual = $this->get(env('API_URL').'/accounts/'.$account->id.'?relationships[]=contacts', $this->getHeadersAuthorization());

        $expected = [
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
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }

    /**
     * @test
     */
    public function find_account_passing_links_parameter()
    {
        $account = Account::factory()->create();

        $actual = $this->get(env('API_URL').'/accounts/'.$account->id.'?links=true', $this->getHeadersAuthorization());

        $expected = [
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
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }
}
