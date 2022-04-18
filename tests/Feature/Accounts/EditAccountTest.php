<?php

namespace Tests\Feature\Accounts;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Accounts\Data\Models\Account;
use Tests\TestCase;

class EditAccountTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     * @group accounts
     */
    public function editing_account_registration_and_not_reporting_status()
    {
        $account = Account::factory()->create();

        $data = [
            'document' => '2345234533453',
            'name' => $this->faker->name,
            'address' => $this->faker->sentence(5),
            'district' => $this->faker->sentence(5),
            'city' => $this->faker->city,
            'complement' => $this->faker->sentence(5),
        ];

        $actual = $this->putJson(env('API_URL').'/accounts/'.$account->id, $data, $this->headersAuthorization);

        $expected = [
            'id' => $account->id,
            'document' => $data['document'], // expected
            'name' => $data['name'], // expected
            'address' => $data['address'], // expected
            'district' => $data['district'], // expected
            'city' => $data['city'], // expected
            'complement' => $data['complement'], // expected
            'status' => $account->status->value,
            'createdAt' => Carbon::parse($account->created_at)->toIso8601String(),
            'updatedAt' => $actual['updatedAt']
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }

    /**
     * @test
     * @group accounts
     */
    public function editing_account_registration_and_reporting_status()
    {
        $account = Account::factory()->create();

        $data = [
            'document' => '2345234533453',
            'name' => $this->faker->name,
            'address' => $this->faker->sentence(5),
            'district' => $this->faker->sentence(5),
            'city' => $this->faker->city,
            'complement' => $this->faker->sentence(5),
            'status' => 5
        ];

        $actual = $this->putJson(env('API_URL').'/accounts/'.$account->id, $data, $this->headersAuthorization);

        $expected = [
            'id' => $account->id,
            'document' => $data['document'],
            'name' => $data['name'],
            'address' => $data['address'],
            'district' => $data['district'],
            'city' => $data['city'],
            'complement' => $data['complement'],
            'status' => $data['status'], // expected
            'createdAt' => Carbon::parse($account->created_at)->toIso8601String(),
            'updatedAt' => $actual['updatedAt']
        ];

        $actual->assertOk();

        $this->assertEquals($expected, $actual->json());
    }
}
