<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasTranslations;

    protected $table = 'media';

    protected $guarded = [];

    protected $translatable = ['alt', 'caption'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function mediable()
    {
        return $this->morphTo();
    }

    public function scopeActive(Builder $q)
    {
        return $q->where('is_active', true);
    }

    public function scopeCollection(Builder $q, $name)
    {
        return $q->where('collection', $name);
    }

    public function scopeOrdered(Builder $q)
    {
        return $q->orderBy('sort_order')->orderBy('id');
    }
}
