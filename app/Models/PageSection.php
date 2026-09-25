<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasTranslations;

    protected $guarded = [];

    protected $translatable = ['eyebrow', 'heading', 'subheading', 'body', 'cta_label'];

    protected $casts = [
        'settings'  => 'array',
        'is_active' => 'boolean',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function scopeActive(Builder $q)
    {
        return $q->where('is_active', true);
    }
}
