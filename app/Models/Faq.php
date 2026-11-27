<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasTranslations;

    protected $guarded = [];

    protected $translatable = ['question', 'answer'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /** Nhãn nhóm hiển thị ngoài site. Khóa phải khớp FaqController::$groups. */
    public static $groupLabels = [
        'booking'   => ['en' => 'Booking', 'vi' => 'Đặt lịch'],
        'aftercare' => ['en' => 'Aftercare', 'vi' => 'Chăm sóc sau xăm'],
        'pricing'   => ['en' => 'Pricing', 'vi' => 'Giá cả'],
        'general'   => ['en' => 'General', 'vi' => 'Chung'],
    ];

    public function getGroupLabelAttribute()
    {
        $locale = app()->getLocale();

        return static::$groupLabels[$this->group][$locale]
            ?? static::$groupLabels[$this->group]['en']
            ?? $this->group;
    }

    public function scopeActive(Builder $q)
    {
        return $q->where('is_active', true);
    }

    /*
     | Câu trả lời còn là bản nháp?
     |
     | Nội dung soạn sẵn để lại chỗ trống dạng [30 minutes], [brand/origin],
     | và một câu còn nguyên ghi chú "for how long??". Những câu này từng lọt
     | ra trang /faqs và lọt cả vào schema FAQPage gửi cho Google.
     |
     | Lọc ở tầng model để mọi nơi dùng Faq đều an toàn, thay vì nhớ lọc ở
     | từng view. Khi nào điền đủ nội dung thì câu tự hiện lại, không phải
     | sửa code.
     |
     | Không lọc bằng SQL vì answer là trường song ngữ (answer_en/answer_vi),
     | phải để HasTranslations chọn bản đúng locale rồi mới soi.
     */
    public function getIsDraftAttribute()
    {
        $traLoi = trim(strip_tags((string) $this->answer));

        if ($traLoi === '') {
            return true;
        }

        // [gì đó] — chỗ trống chưa điền
        if (preg_match('/\[[^\]]{2,}\]/', $traLoi)) {
            return true;
        }

        // "??" — ghi chú tự hỏi còn sót lại
        if (strpos($traLoi, '??') !== false) {
            return true;
        }

        return false;
    }

    /** Chỉ những câu đã viết xong. Dùng kèm active(): Faq::active()->get()->pipe(...) */
    public static function locBanNhap($danhSach)
    {
        return $danhSach->reject(function ($item) {
            return $item->is_draft;
        })->values();
    }

    public function scopeOrdered(Builder $q)
    {
        return $q->orderBy('sort_order')->orderBy('id');
    }
}
