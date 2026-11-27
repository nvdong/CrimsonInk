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

    /**
     * Mới thêm lên đầu — dùng cho carousel trang chủ.
     *
     * Sắp theo id giảm dần chứ không theo created_at: review nhập hàng loạt
     * hoặc seed có thể trùng nhau đến từng giây, lúc đó created_at không đủ
     * phân định và thứ tự sẽ nhảy loạn giữa các lần tải trang. id tăng đơn
     * điệu nên luôn đúng bằng thứ tự thêm vào.
     *
     * Không đụng tới sort_order: admin vẫn kéo thả sắp xếp được, giá trị đó
     * giờ chỉ còn dùng cho danh sách trong admin.
     */
    public function scopeNewest(Builder $q)
    {
        return $q->orderByDesc('id');
    }
}
