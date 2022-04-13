<?php

namespace Modules\Contacts\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

final class ContactCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return  $this->collection->toArray();
    }
}
