<?php

namespace Tests\Feature\Accounts;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Accounts\Data\Models\Account;
use Tests\Feature\OAuth;
use Tests\TestCase;

class DestroyAccountTest extends TestCase
{
    use RefreshDatabase;
    use OAuth;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     */
    public function destroy_account()
    {
        $account = Account::factory()->create();

        $actual = $this->delete(env('API_URL').'/accounts/'.$account->id, $this->getHeadersAuthorization());

        $actual->assertStatus(200);
    }
}
