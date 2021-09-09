<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreRequest;
use App\Repositories\ClientRepository;

class ClientController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function store(StoreRequest $request)
    {
        return $this->clientRepository->create($request->toArray());
    }
}
