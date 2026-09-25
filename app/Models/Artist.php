<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasTranslations, SoftDeletes;

    protected $guarded = [];

    protected $translatable = ['name', 'role', 'bio', 'content', 'meta_title', 'meta_description'];

    protected $casts = [
        'tattoo_style_ids' => 'array',
        'socials'          => 'array',
        'is_featured'      => 'boolean',
        'is_active'        => 'boolean',
    ];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function tattooStyles()
    {
        return TattooStyle::whereIn('id', $this->tattoo_style_ids ?: [])->ordered()->get();
    }

    public function scopeActive(Builder $q)
    {
        return $q->where('is_active', true);
    }

    public function scopeFeatured(Builder $q)
    {
        return $q->where('is_featured', true);
    }

    public function scopeOrdered(Builder $q)
    {
        return $q->orderBy('sort_order')->orderBy('id');
    }
}
