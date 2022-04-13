<?php

namespace Tests\Feature\Contacts;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Contacts\Data\Models\Contact;
use Tests\Feature\OAuth;
use Tests\TestCase;

class DestroyContactTest extends TestCase
{
    use RefreshDatabase;
    use OAuth;
    use WithFaker;
    use DatabaseMigrations;

    /**
     * @test
     */
    public function destroy_contact()
    {
        $contact = Contact::factory()->create();

        $actual = $this->delete(env('API_URL').'/contacts/'.$contact->id, $this->getHeadersAuthorization());

        $actual->assertStatus(200);
    }
}
