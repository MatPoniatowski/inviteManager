<?php

declare(strict_types=1);

namespace App\Domain\Event\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_at',
        'end_at',
    ];

    protected $dates = ['start_at', 'end_at'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = Auth::user()->getAuthIdentifier();
        });
        static::updating(function ($model) {
            $model->user_id = Auth::user()->getAuthIdentifier();
        });
    }

    public function user()
    {
        return $this->belongsTo(\App\Domain\User\Entities\User::class);
    }

    public function scopeUpcoming(Builder $query)
    {
        return $query->where('start_at', '>=', now());
    }

    public function scopeByUser(Builder $query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
