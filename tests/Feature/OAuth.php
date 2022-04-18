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

        $response = $this->postJson(env('APP_URL').'/oauth/token', $data, ['Accept' => 'application/json']);

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
        $client = $client->create($user->id, $user->name, '', null, true, true, true);

        return [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $user->email,
            'password' => 'password',
            'scope' => '*'
        ];
    }
}
