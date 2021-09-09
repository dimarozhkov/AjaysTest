<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreRequest;
use App\Http\Resources\ClientCollection;
use App\Repositories\ClientRepository;
use App\Repositories\UserRepository;

class ClientController extends Controller
{
    private $clientRepository;
    private $userRepository;

    public function __construct(ClientRepository $clientRepository, UserRepository $userRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->toArray();

        $client = $this->clientRepository->create($data);
        $this->userRepository->create($client->id, $data['user']);

        return ['data' => $client->load('users')];
    }

    public function all(): ClientCollection
    {
        return $this->clientRepository->all(
            request()->get('where') ?? [],
            request()->get('orderBy') ?? 'created_at',
            request()->get('orderCondition') ?? 'asc'
        );
    }
}
