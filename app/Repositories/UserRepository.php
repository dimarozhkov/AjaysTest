<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;

class UserRepository implements UserRepositoryInterface
{
    public function create(int $clientId, array $data): User
    {
        $user = (new User())->fill([
            'client_id' => $clientId,
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone' => $data['phone'],
            'profile_uri' => $data['profile_uri'] ?? '',
            'last_password_reset' => Carbon::now(),
            'status' => $data['status'] ?? 'Active',
        ]);

        $user->save();

        return $user;
    }
}
