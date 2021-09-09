<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const STATUSES = [
        'Active' => 'Active',
        'Inactive' => 'Inactive'
    ];

    protected $fillable = [
        'client_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'profile_uri',
        'last_password_reset',
        'status'
    ];

    protected $hidden = [
        'password',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
