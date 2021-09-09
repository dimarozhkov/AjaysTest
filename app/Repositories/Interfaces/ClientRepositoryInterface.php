<?php

namespace App\Repositories\Interfaces;

interface ClientRepositoryInterface
{
    public function all(array $where, string $orderBy, string $orderCondition);
    public function create(array $data);
}
