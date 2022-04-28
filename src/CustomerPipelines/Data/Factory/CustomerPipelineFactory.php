<?php

namespace Microservice\CustomerPipelines\Data\Factory;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;
use Microservice\CustomerPipelines\Data\Models\CustomerPipeline;

class CustomerPipelineFactory extends Factory
{
    protected $model = CustomerPipeline::class;

    #[ArrayShape(['document' => "string", 'name' => "string", 'address' => "string", 'district' => "string", 'city' => "string", 'complement' => "string"])]
    public function definition(): array
    {
        return [
            'document' => (string) rand(111111111111111, 211111111111111),
            'name' => $this->faker->name,
            'address' => $this->faker->sentence(5),
            'district' => $this->faker->sentence(5),
            'city' => $this->faker->city,
            'complement' => $this->faker->sentence(5),
        ];
    }
}
