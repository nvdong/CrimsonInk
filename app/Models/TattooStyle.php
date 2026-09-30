<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TattooStyle extends Model
{
    use HasTranslations, SoftDeletes;

    protected $guarded = [];

    protected $translatable = ['name', 'excerpt', 'content', 'meta_title', 'meta_description'];

    protected $casts = [
        'has_detail_page' => 'boolean',
        'is_featured'     => 'boolean',
        'is_active'       => 'boolean',
    ];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    /** URL của thẻ style: có trang riêng thì vào trang đó, không thì về trang tổng. */
    public function getUrlAttribute()
    {
        if ($this->has_detail_page) {
            return route('page.tattoo-styles.show', $this->slug);
        }

        return route('page.tattoo-styles');
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
