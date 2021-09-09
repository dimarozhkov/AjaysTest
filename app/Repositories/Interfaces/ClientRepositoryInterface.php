<?php

namespace App\Repositories\Interfaces;

interface ClientRepositoryInterface
{
    public function all();
    public function create(array $data);
}
