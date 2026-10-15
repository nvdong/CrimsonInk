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

    /**
      * URL của thẻ style.
      *
      * Trước đây chỗ này đòi has_detail_page = 1 mới trả về trang chi tiết, trong
      * khi route /tattoo-styles/{slug} (PageController::tattooStyle) lại phục vụ
      * MỌI style đang bật và trang /gallery thì link thẳng tới route đó. Kết quả:
      * 16 trang chi tiết vẫn trả 200 nhưng không trang nào trỏ vào -> trang mồ côi,
      * Google coi như không có. Nay lấy đúng điều kiện mà route đang dùng: có slug
      * là link được.
      */
    public function getUrlAttribute()
    {
        if ($this->slug) {
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
