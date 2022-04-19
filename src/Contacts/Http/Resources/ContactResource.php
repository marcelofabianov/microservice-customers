<?php

namespace Microservice\Contacts\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ContactResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
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
            'account_id' => $this->account_id,
            'description' => $this->description,
            'contact' => $this->contact,
            'type' => $this->type,
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
        return ['self' => route('api.contacts.find', $id)];
    }

    /**
     * @param $request
     * @return array
     */
    private function relationships($request): array
    {
        $json = [];
        if (in_array('account', $request)) {
            $json['account'] = [
                'links' => [
                    'related' => route('api.accounts.find', $this->account_id),
                ]
            ];
        }
        return $json;
    }
}
