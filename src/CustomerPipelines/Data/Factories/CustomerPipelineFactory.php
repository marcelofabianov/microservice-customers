<?php

namespace Microservice\CustomerPipelines\Data\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;
use Microservice\CustomerPipelines\Data\Models\CustomerPipeline;

class CustomerPipelineFactory extends Factory
{
    protected $model = CustomerPipeline::class;

    #[ArrayShape(['label' => "string", 'name' => "string"])]
    public function definition(): array
    {
        return [
            'label' => $this->faker->colorName(),
            'name' => $this->faker->hexColor(),
        ];
    }
}
