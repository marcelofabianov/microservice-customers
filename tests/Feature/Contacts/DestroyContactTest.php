<?php

namespace Tests\Feature\Contacts;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Microservice\Contacts\Data\Models\Contact;
use Tests\TestCase;

class DestroyContactTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     * @group contacts
     */
    public function destroy_account()
    {
        $contact = Contact::factory()->create();

        $this->delete(env('API_URL').'/contacts/'.$contact->id, [], $this->headersAuthorization)
            ->assertOk();
    }
}
