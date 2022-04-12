<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;
use JetBrains\PhpStorm\ArrayShape;

trait OAuth
{
    /**
     * @param int|null $id
     * @param string|null $secret
     * @return TestResponse
     */
    public function oauth(int $id = null, string $secret = null): TestResponse
    {
        Artisan::call('passport:install');

        $client = DB::table('oauth_clients')
            ->select('id', 'secret')
            ->first();

        $data = [
            'grant_type' => 'client_credentials',
            'client_id' => $id ?? $client->id,
            'client_secret' => $secret ?? $client->secret,
        ];

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        return $this->postJson('/oauth/token', $data, $headers);
    }

    #[ArrayShape(['Accept' => "string", 'Content-Type' => "string", 'Authorization' => "string"])]
    public function getHeadersAuthorization(): array
    {
        $response = $this->oauth();
        $json = $response->json();

        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$json['access_token']
        ];
    }
}
