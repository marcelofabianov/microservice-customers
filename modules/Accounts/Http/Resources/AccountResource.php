<?php

namespace Modules\Accounts\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class AccountResource extends JsonResource
{
    public function toArray($request): array
    {
        $json = [
            'id' => $this->id,
            'document' => $this->document,
            'name' => $this->name,
            'address' => $this->address,
            'district' => $this->district,
            'city' => $this->city,
            'complement' => $this->complement,
            'status' => $this->status,
            'createdAt' => (Carbon::parse($this->created_at))->toIso8601String(),
            'updatedAt' => (Carbon::parse($this->updated_at))->toIso8601String(),
        ];

        if ($request->has('relationships')) {
            $json['relationships'] = [];
            if (in_array('contacts', $request->get('relationships'))) {
                $json['relationships'] = [
                    'contacts' => [
                        'links' => [
                            'related' => route('api.accounts.contacts', $this->id),
                        ]
                    ],
                ];
            }
        }

        if ($request->get('links') == true) {
            $json['links'] = ['self' => route('api.accounts.show', $this->id)];
        }

        return $json;
    }
}
