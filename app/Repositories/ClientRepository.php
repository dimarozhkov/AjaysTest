<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Resources\ClientCollection;
use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Services\GoogleMapsService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ClientRepository implements ClientRepositoryInterface
{
    public function all(array $where, string $orderBy, string $orderCondition ): ClientCollection
    {
        $client = Client::query();

        if (count($where) > 0) {
            $client->where($where);
        }

        if ($orderBy) {
            $client->orderBy($orderBy, $orderCondition);
        }

        return new ClientCollection($client->paginate());
    }

    public function create(array $data): Client
    {
        $fullAddress = "{$data['address1']}, {$data['city']}, {$data['state']}, {$data['country']}, {$data['zipCode']}";

        $coordinates = Cache::rememberForever($fullAddress, function () use ($fullAddress) {
            return GoogleMapsService::getCoordinates($fullAddress);
        });

        $client = (new Client())->fill([
            'client_name' => $data['name'],
            'address1' => $data['address1'],
            'address2' => $data['address2'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'latitude' => $coordinates['latitude'] ?? 0.0,
            'longitude' => $coordinates['longitude'] ?? 0.0,
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
