<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\ClientRepository;
use Microservice\Contacts\Data\Models\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     *
     */
    public function run()
    {
        Artisan::call('passport:install');

        $user = User::factory()->create([
            'email' => 'user@test.com'
        ]);

        $client = new ClientRepository();
        $client = $client->create($user->id, $user->name, '', null, true, true, true);

        //Contact::factory(1000)->create();

        dd([
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $user->email,
            'password' => $user->password
        ]);
    }
}
