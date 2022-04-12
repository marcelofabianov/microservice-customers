<?php

namespace Tests\Feature\Accounts;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\OAuth;
use Tests\TestCase;

class CreateAccountTest extends TestCase
{
    use RefreshDatabase;
    use OAuth;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     */
    public function creating_new_account_and_not_reporting_status()
    {
        $data = [
            'document' => '2345234533453',
            'name' => $this->faker->name,
            'address' => $this->faker->sentence(5),
            'district' => $this->faker->sentence(5),
            'city' => $this->faker->city,
            'complement' => $this->faker->sentence(5),
        ];

        $actual = $this->postJson(env('API_URL').'/accounts', $data, $this->getHeadersAuthorization());

        $expected = [
            'id' => $actual['id'], // actual
            'document' => $data['document'], // expected
            'name' => $data['name'], // expected
            'address' => $data['address'], // expected
            'district' => $data['district'], // expected
            'city' => $data['city'], // expected
            'complement' => $data['complement'], // expected
            'status' => $actual['status'], // actual
            'createdAt' => $actual['createdAt'], // actual
            'updatedAt' => $actual['updatedAt'], // actual
        ];

        $actual->assertCreated();

        $this->assertEquals($expected, $actual->json());
    }

    /**
     * @test
     */
    public function creating_new_account_and_reporting_status()
    {
        $data = [
            'document' => '2345234533453',
            'name' => $this->faker->name,
            'address' => $this->faker->sentence(5),
            'district' => $this->faker->sentence(5),
            'city' => $this->faker->city,
            'complement' => $this->faker->sentence(5),
            'status' => 4
        ];

        $actual = $this->postJson(env('API_URL').'/accounts', $data, $this->getHeadersAuthorization());

        $expected = [
            'id' => $actual['id'], // actual
            'document' => $data['document'], // expected
            'name' => $data['name'], // expected
            'address' => $data['address'], // expected
            'district' => $data['district'], // expected
            'city' => $data['city'], // expected
            'complement' => $data['complement'], // expected
            'status' => $actual['status'], // actual
            'createdAt' => $actual['createdAt'], // actual
            'updatedAt' => $actual['updatedAt'], // actual
        ];

        $actual->assertCreated();

        $this->assertEquals($expected, $actual->json());
    }
}
