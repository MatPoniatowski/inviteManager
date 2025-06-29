<?php

declare(strict_types=1);

namespace App\Domain\User\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function events()
    {
        return $this->hasMany(\App\Domain\Event\Entities\Event::class);
    }

    public function scopeAdmins($query)
    {
        return $query->role('admin');
    }
}
