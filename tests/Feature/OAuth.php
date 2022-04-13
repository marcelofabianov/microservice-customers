<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\ClientRepository;

trait OAuth
{
    public function setHeadersAutorization()
    {
        Artisan::call('passport:install');

        $data = $this->dataSubmit();

        $response = $this->postJson('/oauth/token', $data, ['Accept' => 'application/json']);

        $jsonResponse = $response->json();

        $this->headersAuthorization = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$jsonResponse['access_token']
        ];
    }

    private function dataSubmit(): array
    {
        $user = User::factory()->create();

        $client = new ClientRepository();
        $client = $client->createPersonalAccessClient($user->id, $user->name, '');

        return [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $user->email,
            'password' => $user->password
        ];
    }
}
