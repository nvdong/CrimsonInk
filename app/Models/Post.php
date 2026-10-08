<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Bài viết blog — /blog và /blog/{slug}. Chỉ tiếng Anh.
 *
 * created_at vừa là ngày đăng (ô ngày trên thẻ ngoài danh sách) vừa là ngày
 * "Cập nhật lần cuối" ở trang chi tiết — chốt như vậy để khỏi thêm cột
 * published_at. Cột này cho sửa trong admin để đăng lại bài cũ với ngày cũ.
 */
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        // cột json: thiếu cast này thì $post->takeaways trả về chuỗi JSON thô
        'takeaways' => 'array',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    /** Người tạo bài trong admin — chỉ để lọc, khác với cột author_name hiển thị. */
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    /** URL công khai của bài viết. */
    public function getUrlAttribute()
    {
        return route('page.blog.show', $this->slug);
    }

    public function scopeActive(Builder $q)
    {
        return $q->where('is_active', true);
    }

    /** Mới nhất trước — đúng thứ tự trang /blog. */
    public function scopeNewestFirst(Builder $q)
    {
        return $q->orderByDesc('created_at')->orderByDesc('id');
    }
}
