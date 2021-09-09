<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function create(int $clientId, array $data);
}
