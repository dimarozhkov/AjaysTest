<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Carbon\Carbon;

class ClientRepository implements ClientRepositoryInterface
{
    public function create(array $data): Client
    {
        $client = (new Client())->fill([
            'client_name' => $data['name'],
            'address1' => $data['address1'],
            'address2' => $data['address2'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'latitude' => 0.0,
            'longitude' => 0.0,
            'phone_no1' => $data['phoneNo1'],
            'phone_no2' => $data['phoneNo2'],
            'zip' => $data['zipCode'],
            'start_validity' => Carbon::now(),
            'end_validity' => Carbon::now()->addDays(15),
            'status' => $data['status'] ?? 'Active',
        ]);

        $client->save();

        return $client;
    }
}
