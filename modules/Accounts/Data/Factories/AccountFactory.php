<?php

namespace Modules\Accounts\Data\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Accounts\Data\Models\Account;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'document' => (string) rand(111111111111111, 211111111111111),
            'name' => $this->faker->name,
            'address' => $this->faker->sentence(5),
            'district' => $this->faker->sentence(5),
            'city' => $this->faker->city,
            'complement' => $this->faker->sentence(5),
            'status' => (string) rand(0, 7),
        ];
    }
}
