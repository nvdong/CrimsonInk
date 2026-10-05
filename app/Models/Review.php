<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasTranslations;

    protected $guarded = [];

    protected $translatable = ['content'];

    protected $dates = ['reviewed_at'];

    protected $casts = [
        'rating'      => 'integer',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    /**
     * Nguồn ảnh đại diện để nhét thẳng vào src. Cột lưu đường dẫn tương đối
     * trong public/ nên phải bọc asset(); rỗng thì trả null để view rơi về ô
     * chữ cái đầu.
     */
    public function getAvatarSrcAttribute()
    {
        return empty($this->author_avatar_path) ? null : asset($this->author_avatar_path);
    }

    /** Ngày hiển thị dạng "2 tuần trước". Rỗng reviewed_at thì trả chuỗi rỗng. */
    public function getDisplayDateAttribute()
    {
        return $this->reviewed_at ? $this->reviewed_at->diffForHumans() : '';
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
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
