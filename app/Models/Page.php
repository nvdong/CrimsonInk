<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasTranslations;

    protected $guarded = [];

    protected $translatable = ['title', 'heading', 'body', 'meta_title', 'meta_description'];

    protected $casts = [
        'noindex'   => 'boolean',
        'is_active' => 'boolean',
    ];

    public function sections()
    {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function scopeActive(Builder $q)
    {
        return $q->where('is_active', true);
    }
}
