<?php

namespace Microservice\Accounts\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

final class AccountCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return  $this->collection->toArray();
    }
}
