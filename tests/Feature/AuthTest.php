<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    use OAuth;
    use WithFaker;
    use DatabaseMigrations;

    public function test_authorized_user_trying_to_authenticate()
    {
        $this->oauth()
            ->assertOk()
            ->assertJsonFragment(['token_type' => 'Bearer']);
    }

    public function test_unauthorized_user_trying_to_login()
    {
        $this->oauth(rand(100, 1000), md5(time()))->assertUnauthorized();
    }
}
