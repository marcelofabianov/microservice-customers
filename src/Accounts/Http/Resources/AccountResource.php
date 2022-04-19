<?php

namespace Microservice\Accounts\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class AccountResource extends JsonResource
{
    public function toArray($request): array
    {
        $json = $this->data();

        if ($request->has('relationships')) {
            $json['relationships'] = $this->relationships($request->get('relationships'));
        }

        if ($request->get('links') == true) {
            $json['links'] = $this->links($this->id);
        }

        return $json;
    }

    /**
     * @return array
     */
    private function data(): array
    {
        return [
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
    }

    /**
     * @param $id
     * @return array
     */
    private function links($id): array
    {
        return ['self' => route('api.accounts.find', $id)];
    }

    /**
     * @param $request
     * @return array
     */
    private function relationships($request): array
    {
        $json = [];
        if (in_array('contacts', $request)) {
            $json['contacts'] = [
                'links' => [
                    'related' => route('api.accounts.contacts', $this->id),
                ]
            ];
        }
        return $json;
    }
}
