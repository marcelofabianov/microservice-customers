<?php

namespace Modules\Contacts\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ContactResource extends JsonResource
{
    public function toArray($request): array
    {
        $json = [
            'id' => $this->id,
            'account_id' => $this->account_id,
            'description' => $this->description,
            'contact' => $this->contact,
            'type' => $this->type,
            'createdAt' => (Carbon::parse($this->created_at))->toIso8601String(),
            'updatedAt' => (Carbon::parse($this->updated_at))->toIso8601String(),
        ];

        if ($request->has('relationships')) {
            $json['relationships'] = [];
            if (in_array('account', $request->get('relationships'))) {
                $json['relationships'] = [
                    'account' => [
                        'links' => [
                            'related' => route('api.accounts.find', $this->account_id),
                        ]
                    ],
                ];
            }
        }

        if ($request->get('links') == true) {
            $json['links'] = ['self' => route('api.contacts.find', $this->id)];
        }

        return $json;
    }
}
