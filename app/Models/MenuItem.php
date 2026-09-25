<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasTranslations;

    protected $guarded = [];

    protected $translatable = ['label'];

    protected $casts = [
        'target_blank' => 'boolean',
        'is_active'    => 'boolean',
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /** Ưu tiên route_name; chỉ dùng url khi trỏ ra ngoài site hoặc chưa có trang. */
    public function getUrlAttribute()
    {
        if ($this->route_name && app('router')->has($this->route_name)) {
            return route($this->route_name);
        }

        return $this->attributes['url'] ?? '#';
    }

    /**
     * Mục này có đang là trang hiện tại không.
     * Mục có menu con thì tính cả khi đang ở một trang con của nó.
     */
    public function isActive()
    {
        if (! $this->route_name) {
            return false;
        }

        $hasChildren = $this->relationLoaded('children') && $this->children->isNotEmpty();

        return request()->routeIs($hasChildren ? $this->route_name.'*' : $this->route_name);
    }

    public function scopeActive(Builder $q)
    {
        return $q->where('is_active', true);
    }

    public function scopeLocation(Builder $q, $location)
    {
        return $q->where('location', $location);
    }

    public function scopeRoots(Builder $q)
    {
        return $q->whereNull('parent_id');
    }

    public function scopeOrdered(Builder $q)
    {
        return $q->orderBy('sort_order')->orderBy('id');
    }
}
