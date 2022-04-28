<?php

namespace Microservice\CustomerPipelines\Data\Entities;

class CustomerPipelineData
{
    public function __construct(
        public string $label,
        public string $name,
    ) {

    }
}
