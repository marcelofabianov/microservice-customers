<?php

namespace Core\Data\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use JetBrains\PhpStorm\NoReturn;
use Laravel\Passport\ClientRepository;

class OAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    #[NoReturn]
    public function run(): void
    {
        Artisan::call('passport:install');

        $user = User::factory()->create([
            'email' => 'user@test.com'
        ]);

        $client = new ClientRepository();
        $client = $client->create($user->id, $user->name, '', null, true, true, true);

        dd([
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $user->email,
            'password' => $user->password
        ]);
    }
}
