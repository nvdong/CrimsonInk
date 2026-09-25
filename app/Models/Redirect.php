<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status_code' => 'integer',
        'hits'        => 'integer',
        'is_active'   => 'boolean',
    ];

    public function scopeActive(Builder $q)
    {
        return $q->where('is_active', true);
    }
}
