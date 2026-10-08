<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Danh mục bài viết blog. Chỉ tiếng Anh, không có cặp _en/_vi.
 *
 * Quan hệ với Post là 1-n qua posts.category_id (không có FK constraint trong
 * DB, theo quy ước của project).
 */
class PostCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    public function scopeActive(Builder $q)
    {
        return $q->where('is_active', true);
    }

    public function scopeOrdered(Builder $q)
    {
        return $q->orderBy('sort_order')->orderBy('name');
    }
}
