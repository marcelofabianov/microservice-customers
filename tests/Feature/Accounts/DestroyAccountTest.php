<?php

namespace Tests\Feature\Accounts;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Microservice\Accounts\Data\Models\Account;
use Tests\TestCase;

class DestroyAccountTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     * @group accounts
     */
    public function destroy_account()
    {
        $account = Account::factory()->create();

        $this->delete(env('API_URL').'/accounts/'.$account->id, [], $this->headersAuthorization)
            ->assertOk();
    }
}
