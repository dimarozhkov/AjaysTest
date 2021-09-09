<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property $users
 */
class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $users = $this->users;
        $usersActive = $users->where('status', 'Active')->count();

        return [
            'id' => $this->id,
            'name' => $this->client_name,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zipCode' => $this->zip,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'phoneNo1' => $this->phone_no1,
            'phoneNo2' => $this->phone_no2,
            'totalUser' => [
                'all' => $users->count(),
                'active' => $usersActive,
                'inactive' => $users->count() - $usersActive,
            ],
            'startValidity' => $this->start_validity,
            'endValidity' => $this->end_validity,
            'status' => $this->status,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
